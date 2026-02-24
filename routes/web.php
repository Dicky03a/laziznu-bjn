<?php

use App\Http\Controllers\Admin\DokumenController as AdminDokumenController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\RekeningController as AdminRekeningController;
use App\Http\Controllers\Admin\SettingControllerProgram;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Public\DonasiController;
use App\Http\Controllers\Public\FidyahController;
use App\Http\Controllers\Public\InfaqController;
use App\Http\Controllers\Public\PaymentController;
use App\Http\Controllers\Public\PublicController as PublicPublicController;
use App\Http\Controllers\Public\ZakatController;
use Illuminate\Support\Facades\Route;

// Routes for public pages
Route::get('/', [PublicPublicController::class, 'index'])->name('home');
Route::get('/profile', [PublicPublicController::class, 'profile'])->name('profile');
Route::get('/pengurus-laziznu-bojonegoro', [PublicPublicController::class, 'pengurus'])->name('pengurus-laziznu-bojonegoro');
Route::get('/rekening-lengkap', [PublicPublicController::class, 'rekening'])->name('rekening-lengkap');
Route::get('/dokumen', [PublicPublicController::class, 'dokumen'])->name('dokumen');
Route::get('/program', [PublicPublicController::class, 'program'])->name('program');
Route::get('/laporan-bulanan', [PublicPublicController::class, 'laporanbulanan'])->name('laporan-bulanan');
Route::get('/laporan-tahunan', [PublicPublicController::class, 'laporantahunan'])->name('laporan-tahunan');
Route::get('/status-mwc-ranting', [PublicPublicController::class, 'statusmwcranting'])->name('status-mwc-ranting');
Route::get('/kalkulator-zakat', [PublicPublicController::class, 'kalkulatorzakat'])->name('kalkulator-zakat');
Route::get('/donasi', [PublicPublicController::class, 'donasi'])->name('donasi');
Route::get('/infaq', [PublicPublicController::class, 'infaq'])->name('infaq');
Route::get('/zakat', [PublicPublicController::class, 'zakat'])->name('zakat');
Route::get('/kebijakan-privasi', [PublicPublicController::class, 'privasi'])->name('kebijakan-privasi');
Route::get('/terms-conditions', [PublicPublicController::class, 'syarat'])->name('terms-conditions');
Route::get('/disclaimer', [PublicPublicController::class, 'disclaimer'])->name('disclaimer');


// Public News routes
Route::get('/berita', [PublicPublicController::class, 'berita'])->name('berita.public.index');
Route::get('/berita/{news:slug}', [AdminNewsController::class, 'show'])->name('berita.show');
Route::get('dokumens/{dokumen}/download', [AdminDokumenController::class, 'download'])->name('dokumens.download');

// Zakat
Route::get('/zakat', [ZakatController::class, 'index'])->name('zakat.index');
Route::post('/zakat/bayar', [ZakatController::class, 'store'])->name('zakat.store');

// DSKL Dana Sosial Keagamaan Lainya 
Route::get('/infaq', [InfaqController::class, 'index'])->name('infaq.index');
Route::get('/infaq/{slug}', [InfaqController::class, 'show'])->name('infaq.show');
Route::post('/infaq/{slug}/bayar', [InfaqController::class, 'store'])->name('infaq.store');

// Infaq Shodaqoh dan Peduli Bencana
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
    Route::get('dashboard', fn() => view('dashboard'))->name('dashboard');

    // Resource routes for admin management
    Route::resource('profiles', AdminProfileController::class);
    Route::resource('rekenings', AdminRekeningController::class);
    Route::resource('news', AdminNewsController::class)->except('show');
    Route::resource('dokumens', AdminDokumenController::class);

    // Program
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


    // Pengurus
    Route::resource('pengurus', PengurusController::class)->parameters([
        'pengurus' => 'pengurus'
    ]);
    Route::patch('pengurus/{pengurus}/toggle-status', [PengurusController::class, 'toggleStatus'])
        ->name('pengurus.toggle-status');
    Route::delete('pengurus/{pengurus}/foto', [PengurusController::class, 'destroyFoto'])
        ->name('pengurus.destroy-foto');
});

require __DIR__ . '/settings.php';
