<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Reservation Routes
Route::prefix('reservasi')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('reservation.index');
    Route::post('/', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/success/{reservation}', [ReservationController::class, 'success'])->name('reservation.success');
    Route::get('/order/{reservation}', [ReservationController::class, 'order'])->name('reservation.order');
    Route::post('/order/{reservation}/add', [ReservationController::class, 'addToOrder'])->name('reservation.addToOrder');
    Route::delete('/order/remove/{orderItem}', [ReservationController::class, 'removeFromOrder'])->name('reservation.removeFromOrder');
    Route::post('/checkout/{order}', [ReservationController::class, 'checkout'])->name('reservation.checkout');
    Route::get('/thankyou', [ReservationController::class, 'thankyou'])->name('reservation.thankyou');
});

// Meja Routes
Route::prefix('meja')->group(function () {
    Route::get('/', [MejaController::class, 'index'])->name('meja.index');
    Route::get('/{meja}', [MejaController::class, 'show'])->name('meja.show');
});

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Admin Protected Routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Menu Management
    Route::get('/menu', [AdminController::class, 'indexMenu'])->name('admin.menu.index');
    Route::get('/menu/create', [AdminController::class, 'createMenu'])->name('admin.menu.create');
    Route::post('/menu', [AdminController::class, 'storeMenu'])->name('admin.menu.store');
    Route::get('/menu/{menu}/edit', [AdminController::class, 'editMenu'])->name('admin.menu.edit');
    Route::put('/menu/{menu}', [AdminController::class, 'updateMenu'])->name('admin.menu.update');
    Route::delete('/menu/{menu}', [AdminController::class, 'destroyMenu'])->name('admin.menu.destroy');
    
    // Meja Management
    Route::get('/meja', [AdminController::class, 'indexMeja'])->name('admin.meja.index');
    Route::get('/meja/create', [AdminController::class, 'createMeja'])->name('admin.meja.create');
    Route::post('/meja', [AdminController::class, 'storeMeja'])->name('admin.meja.store');
    Route::get('/meja/{meja}/edit', [AdminController::class, 'editMeja'])->name('admin.meja.edit');
    Route::put('/meja/{meja}', [AdminController::class, 'updateMeja'])->name('admin.meja.update');
    Route::delete('/meja/{meja}', [AdminController::class, 'destroyMeja'])->name('admin.meja.destroy');
    
    // Reservasi Management
    Route::get('/reservasi', [AdminController::class, 'indexReservasi'])->name('admin.reservasi.index');
    
    // Transaksi Management
    Route::get('/transaksi', [AdminController::class, 'indexTransaksi'])->name('admin.transaksi.index');
});