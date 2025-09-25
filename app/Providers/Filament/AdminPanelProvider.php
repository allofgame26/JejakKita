<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\DashboardWidget;
use App\Filament\Widgets\TestWidget;
use App\Filament\Widgets\ProgramPembangunanWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\EnsureProfileIsComplete;
use Backstage\TwoFactorAuth\TwoFactorAuthPlugin;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Rupadana\ApiService\ApiServicePlugin;

class AdminPanelProvider extends PanelProvider
{


    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('JejakKita')
            ->profile(isSimple: false) // kurang dicustom
            ->emailVerification()
            ->sidebarCollapsibleOnDesktop()
            ->registration()
            ->passwordReset()
            ->login()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                TestWidget::class, // Widget Bisa ditaruh didalam sini
                ProgramPembangunanWidget::class,
                DashboardWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                EnsureProfileIsComplete::class,
                EnsureEmailIsVerified::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                ApiServicePlugin::make(), // harus di masukkan, jika tidak maka API akan tidak terpanggil
                TwoFactorAuthPlugin::make()->forced(),
            ])
            ->renderHook(
                'panels::global-search.after',
                fn () => \Livewire\Livewire::mount(\App\Livewire\GlobalActions::class),
            )
            ;
    }
}
