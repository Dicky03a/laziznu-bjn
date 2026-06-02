<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        $this->configureDefaults();
        $this->scheduleBackups();
        $this->registerObservers();

        // Implicitly grant "super-admin" role all permissions
        // This works in the gate checks and in @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
    }

    /**
     * Schedule backup tasks.
     */
    protected function scheduleBackups(): void
    {
        // Schedule backup runs via cron: * * * * * cd /path && php artisan schedule:run >> /dev/null 2>&1
        if (app()->runningInConsole()) {
            $schedule = app(\Illuminate\Console\Scheduling\Schedule::class);

            // Daily backup at 2 AM
            $schedule->command('backup:run')
                ->dailyAt('02:00')
                ->onSuccess(function () {
                    Log::info('Database backup completed successfully');
                })
                ->onFailure(function () {
                    Log::error('Database backup failed');
                });

            // Monitor backup health daily at 3 AM
            $schedule->command('backup:monitor')
                ->dailyAt('03:00')
                ->onFailure(function () {
                    Log::warning('Backup health check failed');
                });

            // Clean old backups weekly on Monday at 4 AM
            $schedule->command('backup:clean')
                ->weeklyOn(1, '04:00')
                ->onSuccess(function () {
                    Log::info('Old backups cleaned successfully');
                });
        }
    }

    /**
     * Register model observers.
     */
    protected function registerObservers(): void
    {
        \App\Models\Profile::observe(\App\Observers\ProfileObserver::class);
        \App\Models\Pengurus::observe(\App\Observers\PengurusObserver::class);
        \App\Models\News::observe(\App\Observers\NewsObserver::class);
        \App\Models\Program::observe(\App\Observers\ProgramObserver::class);
        \App\Models\Rekening::observe(\App\Observers\RekeningObserver::class);
        \App\Models\Dokuemen::observe(\App\Observers\DokumenObserver::class);
        \App\Models\LaporanBulanan::observe(\App\Observers\LaporanBulananObserver::class);
        \App\Models\LaporanTahunan::observe(\App\Observers\LaporanTahunanObserver::class);
        \App\Models\LaporanMwc::observe(\App\Observers\LaporanMwcObserver::class);
        \App\Models\DistributionProgram::observe(\App\Observers\DistributionProgramObserver::class);
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        \Illuminate\Database\Eloquent\Model::shouldBeStrict(! app()->isProduction());

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn (): ?Password => app()->isProduction()
                ? Password::min(12)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
                : null
        );
    }
}
