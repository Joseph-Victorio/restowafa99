<?php

use App\Http\Controllers\FilterMakanan;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;

Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/midtrans/callback', [OrderController::class, 'callback'])->name('midtrans.callback');
Route::get('/riwayat', [OrderController::class, 'riwayat'])->name('riwayat');


Route::get('/', function () {
    return view('welcomeMenu');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('menu', MenuController::class);
    Route::resource('kategori', KategoriController::class);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/meja/{id?}', [FilterMakanan::class, 'index'])->name('menus.index');


require __DIR__ . '/auth.php';
