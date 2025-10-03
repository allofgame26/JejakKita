<?php

namespace App\Providers;

use App\Models\m_barang;
use App\Models\m_program_pembangunan;
use App\Models\Priority_Pembangunan;
use App\Models\t_transaksi_barang;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use App\Models\User;
use App\Observers\KebutuhanTerpenuhi;
use App\Observers\KodeBarangObserver;
use App\Observers\KodeTransaksiProgram;
use App\Observers\KodeTransaksiSpesifik;
use App\Observers\Pengeluaran;
use App\Observers\ProgramPembangunanObserver;
use App\Observers\RataHargaBarang;
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
        m_program_pembangunan::observe(ProgramPembangunanObserver::class);
        Priority_Pembangunan::observe(ProgramPembangunanObserver::class);
        t_transaksi_donasi_spesifik::observe(TransaksiDonasiObserver::class);
        t_transaksi_donasi_program::observe(TransaksiDonasiObserver::class);
        m_barang::observe(KodeBarangObserver::class);
        User::observe(UserObserver::class);
        t_transaksi_barang::observe(RataHargaBarang::class);
        t_transaksi_barang::observe(KebutuhanTerpenuhi::class);
        t_transaksi_donasi_program::observe(KodeTransaksiProgram::class);
        t_transaksi_donasi_spesifik::observe(KodeTransaksiSpesifik::class);
        t_transaksi_barang::observe(Pengeluaran::class);
        // dipindahkan juga ke EventServiceProvider
    }
}
