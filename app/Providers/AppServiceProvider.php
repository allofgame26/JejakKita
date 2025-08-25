<?php

namespace App\Providers;

use App\Models\m_program_pembangunan;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use App\Observers\ProgramPembangunanObserver;
use App\Observers\TransaksiDonasiObserver;
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
        t_transaksi_donasi_spesifik::observe(TransaksiDonasiObserver::class);
        t_transaksi_donasi_program::observe(TransaksiDonasiObserver::class);
    }
}
