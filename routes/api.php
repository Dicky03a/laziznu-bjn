<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocationController;



Route::middleware('api')->group(function () {
      Route::prefix('locations')->group(function () {
            Route::get('/kecamatans', [LocationController::class, 'getKecamatans'])->name('api.locations.kecamatans');
            Route::get('/desas', [LocationController::class, 'getDesas'])->name('api.locations.desas');
            Route::get('/health', [LocationController::class, 'health'])->name('api.locations.health');
      });
});
