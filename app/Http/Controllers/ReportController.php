<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportDateRange(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $data = $this->getData($startDate, $endDate);

        $pdf = FacadePdf::loadView('filament.laporan.laporanBulanan', $data);

        $filename = 'laporan-keuangan-' . $startDate->format('Y-m-d') . '_ke_' . $endDate->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    public function downloadRealtime()
    {
        $transaksiPertamaDonasiProgram = t_transaksi_donasi_program::where('status_pembayaran', 'sukses')->orderBy('created_at', 'asc')->value('created_at');

        $transaksiPertamaDonasiSpesifik = t_transaksi_donasi_spesifik::where('status_pembayaran', 'sukses')->orderBy('created_at', 'asc')->value('created_at');

        $startDates = null;

        if($transaksiPertamaDonasiProgram && $transaksiPertamaDonasiSpesifik){
            $startDates = $transaksiPertamaDonasiProgram->lt($transaksiPertamaDonasiSpesifik) ? $transaksiPertamaDonasiProgram : $transaksiPertamaDonasiSpesifik;
        } elseif ($transaksiPertamaDonasiProgram) {
            $startDates = $transaksiPertamaDonasiProgram;
        } elseif ($transaksiPertamaDonasiSpesifik) {
            $startDates = $transaksiPertamaDonasiSpesifik;
        } else {
            $startDates = Carbon::now();
        }

        $startDate = Carbon::parse($startDates)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $data = $this->getData($startDate, $endDate, true);

        $pdf = FacadePdf::loadView('filament.laporan.laporanBulanan', $data);

        $filename = 'laporan-keuangan-realtime-' . $endDate->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    private function getData($startDate, $endDate, $detailPengeluaran = false)
    {
        $donasiProgram = t_transaksi_donasi_program::where('status_pembayaran', 'sukses')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('jumlah_donasi');
        $donasiSpesifik = t_transaksi_donasi_spesifik::where('status_pembayaran', 'sukses')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('jumlah_donasi');

        $totalDonasi = $donasiProgram + $donasiSpesifik;

        $pengeluaran = Pengeluaran::whereBetween('tanggal', [$startDate, $endDate])->get();
        $totalPengeluaran = $pengeluaran->sum('jumlah');

        $semuaTransaksi = collect();

        if($detailPengeluaran){
            $transaksiProgram = t_transaksi_donasi_program::with(['user.datadiri', 'pembayaran', 'program'])
                ->where('status_pembayaran', 'sukses')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get()
                ->map(function ($item) {
                    $item->deskripsi_donasi = 'Donasi Program: ' . $item->program->nama_pembangunan;
                    return $item;
                });
            
            $transaksiSpesifik = t_transaksi_donasi_spesifik::with(['user.datadiri', 'pembayaran', 'barang'])
                ->where('status_pembayaran', 'sukses')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get()
                ->map(function ($item) {
                    $item->deskripsi_donasi = 'Donasi Barang: ' . $item->barang->nama_barang;
                    return $item;
                });

            $semuaTransaksi = $transaksiProgram->concat($transaksiSpesifik)->sortBy('created_at');
        }

        return [
            'reportDate' => $endDate,
            'donasi' => $totalDonasi,
            'pengeluaran' => $pengeluaran,
            'totalpengeluaran' => $totalPengeluaran,
            'transaksi' => $semuaTransaksi,
            'detail' => $detailPengeluaran,
            'startDate' => $startDate,
        ];
    }
}
