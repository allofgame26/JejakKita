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
use App\Livewire\Auth\CustomLogin;
use App\Livewire\Auth\LoginCustom;
use Rupadana\ApiService\ApiServicePlugin;

class AdminPanelProvider extends PanelProvider
{


    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('SDIT-AG')
            ->profile(isSimple: false)
            ->emailVerification()
            ->sidebarCollapsibleOnDesktop()
            ->registration()
            ->passwordReset()
            ->login()
            // ->login(CustomLogin::class)
            ->databaseNotifications()
            ->databaseNotificationsPolling('10s')
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                ApiServicePlugin::make(), // harus di masukkan, jika tidak maka API akan tidak terpanggil yang ada didalam route:list
            ])
            ->renderHook(
                'panels::global-search.after',
                fn () => \Livewire\Livewire::mount(\App\Livewire\GlobalActions::class),
            )
            ;
    }
}
