<?php

namespace App\Console\Commands;

use App\Models\t_pengisian_donasi;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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

        // mencari transaksi yang sudah melebih i 24 jam
        $transaksiProgramKadaluarsa = t_transaksi_donasi_program::where('status_pembayaran', 'pending')->where('created_at', '<=' , $waktuBatas)->get();

        if ($transaksiProgramKadaluarsa->isEmpty()){
            $this->info('Tidak ada transaksi kadaluarsa ditemukan.');
            return ;
        }

        $this->info('Transaksi Kadaluarsa Ditemukan : '.$transaksiProgramKadaluarsa->count());

        foreach ($transaksiProgramKadaluarsa as $transaksi){
            $transaksi->status_pembayaran = 'gagal';
            $transaksi->save();
            $this->info("Transaksi Program ID : {$transaksi->id} telah dibatalkan.");
            Log::info("Transaksi Program ID : {$transaksi->id} telah dibatalkan otomatis oleh sistem karena melewati batas waktu 24 jam.");
        }

        $transaksiSpesifikasiKadaluarsa = t_transaksi_donasi_spesifik::where('status_pembayaran', 'pending')->where('created_at', '<=', $waktuBatas)->get();

        if ($transaksiSpesifikasiKadaluarsa->isEmpty()){
            $this->info('Tidak ada transaksi kadaluarsa ditemukan.');
            return ;
        }

        $this->info('Transaksi Kadaluarsa Ditemukan : '.$transaksiSpesifikasiKadaluarsa->count());

        foreach ($transaksiSpesifikasiKadaluarsa as $transaksiSpesifikasi){
            $transaksiSpesifikasi->status_pembayaran = 'gagal';
            $transaksiSpesifikasi->save();
            $this->info("Transaksi Program ID : {$transaksi->id} telah dibatalkan.");
            Log::info("Transaksi Spesifik ID : {$transaksiSpesifikasi->id} telah dibatalkan otomatis oleh sistem karena melewati batas waktu 24 jam.");
        }

        $this->info('Pengecekan Selesai');
    }
}
