<?php

namespace App\Filament\Pages;

// use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults as BaseHealthCheckResults;

class HealthCheckResults extends BaseHealthCheckResults
{
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?int $navigationSort = 2;

    public function getHeading(): string | Htmlable
    {
        return 'Health Check Results';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }
}
