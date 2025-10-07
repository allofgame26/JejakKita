<?php

namespace App\Console\Commands;

use App\Models\t_pengisian_donasi;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BatalkanTransaksiKadaluarsa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:batalkan-transaksi-kadaluarsa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mencari dan Membatalkan transaksi yang pending lebih dari 24 jam';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai pengecekan transaksi kadaluarsa');

        $waktuBatas = Carbon::now()->subHours(24); // menentukan waktu 24 jam yang lalu

        // mencari transaksi yang sudah melebihi 24 jam
        $transaksiProgramKadaluarsa = t_transaksi_donasi_program::where('status_pembayaran', 'pending')->where('created_at', '<=' , $waktuBatas)->get();

        foreach ($transaksiProgramKadaluarsa as $transaksi){
            $transaksi->status_pembayaran = 'gagal';
            $transaksi->save();
            $this->info("Transaksi Program ID : {$transaksi->id} telah dibatalkan.");
        }

        $transaksiSpesifikasiKadaluarsa = t_transaksi_donasi_spesifik::where('status_pembayaran', 'pending')->where('created_at', '<=', $waktuBatas)->get();

        foreach ($transaksiSpesifikasiKadaluarsa as $transaksiSpesifikasi){
            $transaksiSpesifikasi->status_pembayaran = 'gagal';
            $transaksiSpesifikasi->save();
            $this->info("Transaksi Program ID : {$transaksi->id} telah dibatalkan.");
        }

        $this->info('Pengecekan Selesai');

        return 0;


    }
}
