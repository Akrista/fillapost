<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Pages\HealthCheckResults;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\ServiceAccountResource;
use App\Filament\Resources\SocialMediaServiceResource;
use Awcodes\Curator\CuratorPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('fillapost')
            ->path('/')
            ->login()
            ->colors([
                'primary' => Color::Red,
            ])
            ->viteTheme('resources/css/filament/fillapost/theme.css')
            ->breadcrumbs(false)
            ->brandName('Fillapost')
            ->favicon(asset('favicon.svg'))
            ->resources([
                PostResource::class,
                SocialMediaServiceResource::class,
                ServiceAccountResource::class,
                config('filament-logger.activity_resource'),
            ])
            ->pages([
                Dashboard::class,
            ])
            ->navigationItems([
                NavigationItem::make('Create Post')
                    ->icon('heroicon-o-plus-circle')
                    ->sort(1),
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Content')
                    ->collapsible(false),
                NavigationGroup::make()
                    ->label('Settings')
                    ->collapsible(false)
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->sidebarCollapsibleOnDesktop()
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->plugins([
                FilamentSpatieLaravelHealthPlugin::make()->usingPage(HealthCheckResults::class),
                FilamentApexChartsPlugin::make(),
                SpotlightPlugin::make(),
                CuratorPlugin::make()
            ]);
    }
}
