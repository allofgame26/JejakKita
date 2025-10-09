<?php

namespace App\Console\Commands;

use App\Models\Pengeluaran;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class LaporanBulanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a PDF financial report for the previous month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating financial report for the previous month...');

        // menentukan periode bulan lalu
        $reportDate = Carbon::now()->subMonth();
        $firstDay = $reportDate->copy()->startOfMonth();
        $lastDay = $reportDate->copy()->endOfMonth();

        //ambil data dari database
        $donasiProgram = t_transaksi_donasi_program::where('status_pembayaran', 'sukses')->whereBetween('created_at', [$firstDay,$lastDay])->sum('jumlah_donasi');

        $donasiSpesifikasi = t_transaksi_donasi_spesifik::where('status_pembayaran','sukses')->whereBetween('created_at', [$firstDay,$lastDay])->sum('jumlah_donasi');

        $totalDonasi = $donasiProgram + $donasiSpesifikasi;

        $pengeluaran = Pengeluaran::whereBetween('tanggal',[$firstDay,$lastDay])->get();
        $totalPengeluaran = $pengeluaran->sum('jumlah');

        $data = [
            'reportDate' => $reportDate,
            'donasi' => $totalDonasi,
            'pengeluaran' => $pengeluaran,
            'totalpengeluaran' => $totalPengeluaran
        ];

        $pdf = Pdf::loadView('filament.laporan.laporanBulanan', $data);

        $fileName = 'laporan-keuangan-' . $reportDate->format('Y-m'). '.pdf';
        Storage::put('public/laporan/' .$fileName, $pdf->output());

        $this->info('Report successfully generated: ' . $fileName);

        return Command::SUCCESS;
    }
}
