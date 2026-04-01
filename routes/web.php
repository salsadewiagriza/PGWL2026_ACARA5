<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonsController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman peta dan tabel
Route::get('/peta', [PageController::class, 'peta'])->name('peta');
Route::get('/tabel', [PageController::class, 'tabel'])->name('tabel');

// Points (CRUD minimal: store)
Route::post('/store-points', [PointsController::class, 'store'])->name('points.store');

// Polylines (CRUD minimal: store)
Route::post('/store-polylines', [PolylinesController::class, 'store'])->name('polylines.store');

// Polygons (CRUD lengkap)
Route::prefix('polygons')->group(function () {
    Route::get('/', [PolygonsController::class, 'index'])->name('polygons.index'); // tampilkan semua polygons
    Route::get('/create', [PolygonsController::class, 'create'])->name('polygons.create'); // form tambah
    Route::post('/store', [PolygonsController::class, 'store'])->name('polygons.store'); // simpan
    Route::get('/{id}/edit', [PolygonsController::class, 'edit'])->name('polygons.edit'); // form edit
    Route::put('/{id}', [PolygonsController::class, 'update'])->name('polygons.update'); // update
    Route::delete('/{id}', [PolygonsController::class, 'destroy'])->name('polygons.destroy'); // hapus
});

// Dashboard dengan middleware auth
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Include file settings tambahan
require __DIR__.'/settings.php';