<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* ---------- Publik ---------- */
Route::get('/', function () {
    return view('welcome');
});
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

/* ---------- Login saja (semua role) ---------- */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Artikel: akses dibatasi oleh PostPolicy (create: admin/editor, edit/delete: pemilik/admin)
    Route::resource('posts', PostController::class);
});

/* ---------- Khusus role tertentu (custom middleware) ---------- */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
});

Route::middleware(['auth', 'role:admin,editor'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'editor'])->name('dashboard');
});

require __DIR__ . '/auth.php';
