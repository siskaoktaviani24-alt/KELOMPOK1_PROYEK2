<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\BookingTempatController as AdminBookingTempatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\MejaController as AdminMejaController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\BookingController;  
use App\Http\Controllers\BookingTempatController;  
use App\Http\Controllers\MenuController;  
use App\Http\Controllers\Auth\LoginController;


// ==================== AUTH ROUTES ====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ==================== ROOT ROUTE ====================
Route::get('/', function () {
    return auth()->check() ? redirect('/admin/dashboard') : view('welcome');
});


// ==================== FRONTEND ROUTES ====================

// Booking (Pesanan menu)
Route::resource('booking', BookingController::class);

// Booking Tempat (Reservasi meja)
Route::prefix('booking-tempat')->name('booking_tempat.')->group(function () {
    Route::get('/', [BookingTempatController::class, 'index'])->name('index');
    Route::get('/create', [BookingTempatController::class, 'create'])->name('create');
    Route::post('/store', [BookingTempatController::class, 'store'])->name('store');
    Route::get('/success/{id}', [BookingTempatController::class, 'success'])->name('success');
    Route::get('/payment/{id}', [BookingTempatController::class, 'processPayment'])->name('payment');
    Route::get('/menu/{id}', [BookingTempatController::class, 'toMenu'])->name('menu');
    Route::put('/{id}/status', [BookingTempatController::class, 'updateStatus'])->name('updateStatus');
});

// Menu halaman user
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/categories', [MenuController::class, 'categories'])->name('menu.categories');
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');

// Cart
Route::post('/booking/add-to-cart', [BookingController::class, 'addToCart'])->name('booking.addToCart');
Route::post('/booking/remove-from-cart', [BookingController::class, 'removeFromCart'])->name('booking.removeFromCart');
Route::get('/booking/get-cart', [BookingController::class, 'getCart'])->name('booking.getCart');
Route::post('/booking/clear-cart', [BookingController::class, 'clearCart'])->name('booking.clearCart');
Route::post('/booking/process-dana', [BookingController::class, 'processDanaPayment'])->name('booking.processDana');


// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Management
    Route::resource('menu', AdminMenuController::class);

    // Meja Management (CRUD)
    Route::resource('meja', AdminMejaController::class);

    // Toggle meja (biru/abu)
    Route::post('/meja/{id}/toggle', [AdminMejaController::class, 'toggle'])
        ->name('meja.toggle');

    // Booking Tempat Management
    Route::prefix('booking-tempat')->name('booking-tempat.')->group(function () {
        Route::get('/', [AdminBookingTempatController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminBookingTempatController::class, 'show'])->name('show');
        Route::put('/{id}/status', [AdminBookingTempatController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{id}', [AdminBookingTempatController::class, 'destroy'])->name('destroy');
    });

    // Booking Management
    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('/', [AdminBookingController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminBookingController::class, 'show'])->name('show');
        Route::put('/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{id}', [AdminBookingController::class, 'destroy'])->name('destroy');
    });

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
});


// ==================== FALLBACK ====================
Route::fallback(function () {
    return view('welcome');
});
