<?php

use App\Http\public\PublicController;
use Illuminate\Support\Facades\Route;

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


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
