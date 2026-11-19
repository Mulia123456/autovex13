<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\KendaraanController;
use App\Http\Controllers\Api\DaftarServiceController;
use App\Http\Controllers\Api\DataServiceController;
use App\Http\Controllers\Api\PembayaranServiceController;

Route::apiResource('pelanggans', PelangganController::class);

Route::apiResource('kendaraans', KendaraanController::class);

Route::apiResource('daftar-services', DaftarServiceController::class)
    ->parameters(['daftar-services' => 'daftarService']);

Route::apiResource('data-services', DataServiceController::class)
    ->parameters(['data-services' => 'dataService']);

Route::apiResource('pembayaran-services', PembayaranServiceController::class)
    ->parameters(['pembayaran-services' => 'pembayaranService']);

