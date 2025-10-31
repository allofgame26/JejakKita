<?php

namespace App\Providers;

use App\Models\m_barang;
use App\Models\m_program_pembangunan;
use App\Models\Priority;
use App\Models\Priority_Pembangunan;
use App\Models\t_transaksi_barang;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use App\Models\User;
use App\Observers\KodeBarangObserver;
use App\Observers\ProgramPembangunan;
use App\Observers\ProgramPembangunanObserver;
use App\Observers\TransaksiBarang;
use App\Observers\TransaksiProgram;
use App\Observers\TransaksiSpesifik;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        Priority_Pembangunan::class => [ProgramPembangunanObserver::class],
        // t_transaksi_donasi_spesifik::class => [TransaksiDonasiObserver::class],
        // t_transaksi_donasi_program::class => [TransaksiDonasiObserver::class],
        m_barang::class => [KodeBarangObserver::class],
        User::class => [UserObserver::class],
        t_transaksi_donasi_program::class => [TransaksiProgram::class],
        t_transaksi_donasi_spesifik::class => [TransaksiSpesifik::class],
        m_program_pembangunan::class => [ProgramPembangunan::class],
        t_transaksi_barang::class => [TransaksiBarang::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // m_program_pembangunan::observe(ProgramPembangunan::class);
        // t_transaksi_barang::observe(TransaksiBarang::class);
        // t_transaksi_donasi_program::observe(TransaksiProgram::class);
        // t_transaksi_donasi_spesifik::observe(TransaksiSpesifik::class);
        // m_barang::observe(KodeBarangObserver::class);
        // Priority_Pembangunan::observe(ProgramPembangunanObserver:: class);
        // User::observe(UserObserver::class);

        
        // m_program_pembangunan::observe(KodeProgram::class);
        // m_program_pembangunan::observe(ProgramPembangunanObserver:: class);
        // t_transaksi_donasi_program::observe(TransaksiDonasiObserver::class);
        // t_transaksi_donasi_spesifik::observe(TransaksiDonasiObserver::class);
        // t_transaksi_barang::observe(RataHargaBarang::class);
        // t_transaksi_barang::observe(KebutuhanTerpenuhi::class);
        // t_transaksi_barang::observe(DoneTransaksiBarangObserver::class);
        // t_transaksi_barang::observe(Pengeluaran::class);
        // m_program_pembangunan::observe(tanggalSelesaiPembangunan::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
