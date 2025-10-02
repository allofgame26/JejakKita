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
use App\Observers\ProgramPembangunanObserver;
use App\Observers\RataHargaBarang;
use App\Observers\TransaksiDonasiObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $observers = [
        m_program_pembangunan::class => ProgramPembangunanObserver::class,
        Priority_Pembangunan::class => ProgramPembangunanObserver::class,
        t_transaksi_donasi_spesifik::class => TransaksiDonasiObserver::class,
        t_transaksi_donasi_program::class => TransaksiDonasiObserver::class,
        m_barang::class => KodeBarangObserver::class,
        User::class => UserObserver::class,
        t_transaksi_barang::class => RataHargaBarang::class,
        t_transaksi_barang::class => KebutuhanTerpenuhi::class,
        t_transaksi_donasi_program::class => KodeTransaksiProgram::class,
        t_transaksi_donasi_spesifik::class => KodeTransaksiSpesifik::class,
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
