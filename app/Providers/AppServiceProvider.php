<?php

namespace App\Providers;

use App\Models\m_program_pembangunan;
use App\Observers\ProgramPembangunanObserver;
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
    }
}
