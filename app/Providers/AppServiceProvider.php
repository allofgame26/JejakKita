<?php

namespace App\Providers;

use App\Models\m_barang;
use App\Models\m_program_pembangunan;
use App\Models\Priority_Pembangunan;
use App\Models\t_transaksi_barang;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use App\Models\User;
use App\Observers\DoneTransaksiBarangObserver;
use App\Observers\KebutuhanTerpenuhi;
use App\Observers\KodeBarangObserver;
use App\Observers\KodeProgram;
use App\Observers\KodeTransaksiProgram;
use App\Observers\KodeTransaksiSpesifik;
use App\Observers\Pengeluaran;
use App\Observers\ProgramPembangunanObserver;
use App\Observers\RataHargaBarang;
use App\Observers\tanggalSelesaiPembangunan;
use App\Observers\TransaksiDonasiObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
