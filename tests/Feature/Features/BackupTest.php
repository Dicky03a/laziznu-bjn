<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

describe('Database Backup System', function () {
    it('can create a backup successfully', function () {
        // Clean up any existing backups first
        Storage::disk('local')->deleteDirectory('Laravel');

        // Run backup command
        $exitCode = Artisan::call('backup:run');

        expect($exitCode)->toBe(0);
        expect(Storage::disk('local')->exists('Laravel'))->toBeTrue();
    });

    it('backup files are created in correct location', function () {
        // Verify backup directory structure
        $files = Storage::disk('local')->files('Laravel');

        expect(count($files))->toBeGreaterThan(0);

        // Verify backup file is zip
        $zipFiles = array_filter($files, fn($file) => str_ends_with($file, '.zip'));
        expect(count($zipFiles))->toBeGreaterThan(0);
    });

    it('can verify backup health status', function () {
        // Run backup:monitor command
        $exitCode = Artisan::call('backup:monitor');

        expect($exitCode)->toBe(0);
    });

    it('can list all available backups', function () {
        // Run backup:list command
        $exitCode = Artisan::call('backup:list');

        expect($exitCode)->toBe(0);
    });

    it('backup configuration is properly set', function () {
        $config = config('backup');

        // Verify essential configuration
        expect($config)->toHaveKey('backup.source.databases')
            ->and($config['backup']['source']['databases'])->toContain(env('DB_CONNECTION', 'mysql'))
            ->and($config['backup']['destination']['disks'])->toContain('local');
    });

    it('database dump is compressed with gzip', function () {
        $config = config('backup');
        $compressor = $config['backup']['database_dump_compressor'];

        expect($compressor)->toBe(\Spatie\DbDumper\Compressors\GzipCompressor::class);
    });

    it('backup retention policy is configured', function () {
        $config = config('backup');
        $strategy = $config['cleanup']['default_strategy'];

        expect($strategy)->toHaveKey('keep_all_backups_for_days')
            ->and($strategy['keep_all_backups_for_days'])->toBe(14)
            ->and($strategy['keep_daily_backups_for_days'])->toBe(30)
            ->and($strategy['keep_weekly_backups_for_weeks'])->toBe(8)
            ->and($strategy['keep_yearly_backups_for_years'])->toBe(3);
    });
});
