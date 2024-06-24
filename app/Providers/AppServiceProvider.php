<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\BackupsCheck;
// use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DatabaseSizeCheck;
// use Spatie\Health\Checks\Checks\DatabaseTableSizeCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
// use Spatie\Health\Checks\Checks\FlareErrorOccurrenceCountCheck;
// use Spatie\Health\Checks\Checks\HorizonCheck;
// use Spatie\Health\Checks\Checks\MeiliSearchCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
// use Spatie\Health\Checks\Checks\PingCheck;
// use Spatie\Health\Checks\Checks\QueueCheck;
// use Spatie\Health\Checks\Checks\RedisCheck;
// use Spatie\Health\Checks\Checks\RedisMemoryUsageCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Z3d0X\FilamentLogger\Resources\ActivityResource;

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
        Health::checks([
            OptimizedAppCheck::new(),
            // CacheCheck::new(),
            BackupsCheck::new()->locatedAt('/storage/*.zip')
                ->numberOfBackups(min: 5, max: 10),
            UsedDiskSpaceCheck::new()
                ->warnWhenUsedSpaceIsAbovePercentage(60)
                ->failWhenUsedSpaceIsAbovePercentage(80),
            DatabaseCheck::new(),
            DatabaseConnectionCountCheck::new()
                ->warnWhenMoreConnectionsThan(50)
                ->failWhenMoreConnectionsThan(100),
            DatabaseSizeCheck::new()
                ->failWhenSizeAboveGb(errorThresholdGb: 5.0),
            // DatabaseTableSizeCheck::new(),
            ScheduleCheck::new(),
            EnvironmentCheck::new(),
            DebugModeCheck::new(),
            // FlareErrorOccurrenceCountCheck::new(),
            // PingCheck::new(),
            // MeiliSearchCheck::new(),
            // HorizonCheck::new(),
            // QueueCheck::new(),
            // RedisCheck::new(),
            // RedisMemoryUsageCheck::new(),
        ]);

        ActivityResource::navigationSort(3);
    }
}
