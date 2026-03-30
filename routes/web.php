<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

Route::redirect('/', '/login');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Rute Dashboard 
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang', [BarangController::class, 'store']);
    // Rute Controller Bararng
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/barang/{id}', [BarangController::class, 'update']);
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
    // Rute Transaksi
    Route::get('/kasir', [TransaksiController::class, 'index']);
    Route::post('/kasir/tambah', [TransaksiController::class, 'tambahKeranjang']);
    Route::post('/kasir/reset', [TransaksiController::class, 'resetKeranjang']);
    Route::post('/kasir/bayar', [TransaksiController::class, 'bayar']);
    // Rute Mesin Kasir
    Route::middleware(['auth'])->group(function () {
        Route::get('/kasir', [TransaksiController::class, 'index']);
        Route::post('/kasir/tambah', [TransaksiController::class, 'tambahKeranjang']);
        Route::post('/kasir/reset', [TransaksiController::class, 'resetKeranjang']);
        Route::post('/kasir/bayar', [TransaksiController::class, 'bayar']);
    });
    // Rute Khusus Superadmin
    Route::middleware(['auth', 'role:Super Admin'])->group(function () {
        Route::get('/user', [UserController::class, 'index']);
        Route::post('/user', [UserController::class, 'store']);
        Route::delete('/user/{id}', [UserController::class, 'destroy']);
    });
    // Rute Khusus Admin & Superadmin
    Route::middleware(['auth', 'role:Admin,Super Admin'])->group(function () {
        // Rute Barang yang sudah ada...
        Route::get('/barang', [BarangController::class, 'index']);
        Route::post('/barang', [BarangController::class, 'store']);
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/barang/{id}', [BarangController::class, 'update']);
        Route::delete('/barang/{id}', [BarangController::class, 'destroy']);

        // Rute Laporan
        Route::get('/laporan', [LaporanController::class, 'index']);
    });
});

require __DIR__ . '/auth.php';
