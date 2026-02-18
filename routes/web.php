<?php

use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\SettingControllerProgram;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\DonasiController;
use App\Http\Controllers\Public\FidyahController;
use App\Http\Controllers\Public\InfaqController;
use App\Http\Controllers\Public\PaymentController;
use App\Http\Controllers\Public\ZakatController;
use App\Http\Controllers\RekeningController;
use App\Http\public\PublicController;
use Illuminate\Support\Facades\Route;

// Routes for public pages
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/profile', [PublicController::class, 'profile'])->name('profile');
Route::get('/pengurus-laziznu-bojonegoro', [PublicController::class, 'pengurus'])->name('pengurus-laziznu-bojonegoro');
Route::get('/rekening-lengkap', [PublicController::class, 'rekening'])->name('rekening-lengkap');
Route::get('/dokumen', [PublicController::class, 'dokumen'])->name('dokumen');
Route::get('/press-release', [PublicController::class, 'pressrelease'])->name('press-release');
Route::get('/program', [PublicController::class, 'program'])->name('program');
Route::get('/laporan-bulanan', [PublicController::class, 'laporanbulanan'])->name('laporan-bulanan');
Route::get('/laporan-tahunan', [PublicController::class, 'laporantahunan'])->name('laporan-tahunan');
Route::get('/status-mwc-ranting', [PublicController::class, 'statusmwcranting'])->name('status-mwc-ranting');
Route::get('/kalkulator-zakat', [PublicController::class, 'kalkulatorzakat'])->name('kalkulator-zakat');
Route::get('/donasi', [PublicController::class, 'donasi'])->name('donasi');
Route::get('/infaq', [PublicController::class, 'infaq'])->name('infaq');
Route::get('/zakat', [PublicController::class, 'zakat'])->name('zakat');
Route::get('/kebijakan-privasi', [PublicController::class, 'privasi'])->name('kebijakan-privasi');
Route::get('/terms-conditions', [PublicController::class, 'syarat'])->name('terms-conditions');
Route::get('/disclaimer', [PublicController::class, 'disclaimer'])->name('disclaimer');

// Public News routes
Route::get('/berita', [PublicController::class, 'berita'])->name('berita.public.index');
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('berita.show');
Route::get('dokumens/{dokumen}/download', [DokumenController::class, 'download'])->name('dokumens.download');

// Zakat
Route::get('/zakat', [ZakatController::class, 'index'])->name('zakat.index');
Route::post('/zakat/bayar', [ZakatController::class, 'store'])->name('zakat.store');

// Infaq
Route::get('/infaq', [InfaqController::class, 'index'])->name('infaq.index');
Route::get('/infaq/{slug}', [InfaqController::class, 'show'])->name('infaq.show');
Route::post('/infaq/{slug}/bayar', [InfaqController::class, 'store'])->name('infaq.store');

// Donasi
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/{slug}', [DonasiController::class, 'show'])->name('donasi.show');
Route::post('/donasi/{slug}/bayar', [DonasiController::class, 'store'])->name('donasi.store');

// Fidyah
Route::get('/fidyah', [FidyahController::class, 'index'])->name('fidyah.index');
Route::post('/fidyah/bayar', [FidyahController::class, 'store'])->name('fidyah.store');

// Payment (halaman instruksi + konfirmasi)
Route::get('/pembayaran/{kode}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/pembayaran/{kode}/konfirmasi', [PaymentController::class, 'confirm'])->name('payment.confirm');
Route::get('/pembayaran/{kode}/status', [PaymentController::class, 'status'])->name('payment.status');

// Protected routes for authenticated users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::resource('profiles', ProfileController::class);
    Route::resource('rekenings', RekeningController::class);
    Route::resource('news', NewsController::class)->except('show');
    Route::resource('dokumens', DokumenController::class);

    Route::resource('programs', ProgramController::class);
    Route::patch('programs/{program}/toggle-active', [ProgramController::class, 'toggleActive'])
        ->name('programs.toggle-active');

    // Transactions
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/export', [TransactionController::class, 'export'])->name('transactions.export');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('transactions/{transaction}/confirm', [TransactionController::class, 'confirm'])->name('transactions.confirm');
    Route::post('transactions/{transaction}/reject', [TransactionController::class, 'reject'])->name('transactions.reject');

    // Settings (Fidyah, Zakat Fitrah, Nisab, dll)
    Route::get('program/settings', [SettingControllerProgram::class, 'index'])->name('program.edit');
    Route::put('settings/program', [SettingControllerProgram::class, 'update'])->name('program.settings');
});

require __DIR__.'/settings.php';
