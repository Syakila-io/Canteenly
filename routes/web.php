<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Landing Page (development landing view)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes
Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
Route::get('/produk', [ProductController::class, 'index'])->name('produk');
Route::get('/pesanan', [OrderController::class, 'userOrders'])->name('pesanan');
Route::put('/pesanan/{id}/cancel', [OrderController::class, 'cancel'])->name('pesanan.cancel');
Route::delete('/pesanan/{id}', [OrderController::class, 'delete'])->name('pesanan.delete');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
Route::get('/wishlist', [DashboardController::class, 'wishlist'])->name('wishlist');
Route::get('/riwayat', [OrderController::class, 'riwayat'])->name('riwayat');

// Admin Routes - Protected
Route::group(['middleware' => function ($request, $next) {
    if (session('user_role') !== 'admin') {
        return redirect()->route('login')->withErrors(['access' => 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.']);
    }
    return $next($request);
}], function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/produk', [ProductController::class, 'adminIndex'])->name('admin.produk');
    Route::get('/admin/produk/tambah', [ProductController::class, 'create'])->name('admin.tambah-produk');
    Route::post('/admin/produk', [ProductController::class, 'store'])->name('admin.produk.store');
    Route::get('/admin/produk/edit/{id}', [ProductController::class, 'edit'])->name('admin.edit-produk');
    Route::put('/admin/produk/{id}', [ProductController::class, 'update'])->name('admin.produk.update');
    Route::delete('/admin/produk/{id}', [ProductController::class, 'destroy'])->name('admin.produk.destroy');
    Route::get('/admin/pesanan', [OrderController::class, 'index'])->name('admin.pesanan');
    Route::delete('/admin/pesanan/delete-all', [OrderController::class, 'deleteAll'])->name('admin.pesanan.delete-all');
    Route::get('/admin/pesanan/count', [OrderController::class, 'getOrderCount'])->name('admin.pesanan.count');
    Route::get('/admin/pesanan/pending', [OrderController::class, 'getPendingOrders'])->name('admin.pesanan.pending');
    Route::get('/admin/pesanan/totals', [OrderController::class, 'getTotals'])->name('admin.pesanan.totals');
    Route::post('/admin/pesanan/complete-all', [OrderController::class, 'completeAllPending'])->name('admin.pesanan.complete_all');
    Route::put('/admin/pesanan/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.pesanan.status');
    Route::get('/admin/pesanan/edit/{id}', [OrderController::class, 'edit'])->name('admin.pesanan.edit');
    Route::put('/admin/pesanan/{id}', [OrderController::class, 'update'])->name('admin.pesanan.update');
    Route::delete('/admin/pesanan/{id}', [OrderController::class, 'destroy'])->name('admin.pesanan.destroy');
    Route::get('/admin/notifikasi', [DashboardController::class, 'notifications'])->name('admin.notifikasi');
    Route::get('/admin/users', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/tambah', [\App\Http\Controllers\UserController::class, 'create'])->name('admin.tambah-user');
    Route::post('/admin/users', [\App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/edit/{id}', [\App\Http\Controllers\UserController::class, 'edit'])->name('admin.edit-user');
    Route::put('/admin/users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');
});

// API Routes for Real-time Notifications
Route::get('/api/user/orders/completed', function() {
    try {
        $userId = session('user_id');
        $count = \App\Models\Order::where('user_id', $userId)->where('status', 'Selesai')->count();
        return response()->json(['count' => $count]);
    } catch (\Exception $e) {
        return response()->json(['count' => 0]);
    }
});

// Return total spent by current user (for user dashboard)
Route::get('/api/user/total-spent', [OrderController::class, 'getUserTotalSpent'])->name('api.user.total_spent');

// Google Authentication Routes
Route::get('/google/login', [AuthController::class, 'googleLogin'])->name('google.login');
Route::get('/google/register', function () {
    return redirect()->route('google.login');
})->name('google.register');
Route::post('/google/callback', [AuthController::class, 'googleCallback'])->name('google.callback');












