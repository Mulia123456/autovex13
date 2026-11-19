
<?php

use Illuminate\Support\Facades\Route;

use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\DaftarService;
use App\Models\PembayaranService;

use App\Http\Controllers\PelangganWebController;
use App\Http\Controllers\KendaraanWebController;
use App\Http\Controllers\DaftarServiceWebControllerBaru;
use App\Http\Controllers\DataServiceWebController;
use App\Http\Controllers\PembayaranServiceWebController;

// DASHBOARD
Route::get('/', function () {
    return view('dashboard', [
        'totalPelanggan' => Pelanggan::count(),
        'totalKendaraan' => Kendaraan::count(),
        'totalDaftarService' => DaftarService::count(),
        'totalPembayaran' => PembayaranService::count(),
    ]);
});

// DATA PELANGGAN
Route::resource('pelanggan', PelangganWebController::class)
    ->except(['show']);

// DATA KENDARAAN
Route::resource('kendaraan', KendaraanWebController::class)
    ->except(['show']);

// DAFTAR SERVICE
Route::resource('daftar-service', DaftarServiceWebControllerBaru::class)
    ->parameters(['daftar-service' => 'daftarService'])
    ->except(['show']);

// DATA SERVICE
Route::resource('data-service', DataServiceWebController::class)
    ->parameters(['data-service' => 'dataService'])
    ->except(['show']);

// PEMBAYARAN SERVICE
Route::resource('pembayaran-service', PembayaranServiceWebController::class)
    ->parameters(['pembayaran-service' => 'pembayaranService'])
    ->except(['show']);
