<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\PenggunaController;

Route::get('/', function () {
    return view('auth.pagelogin');
})->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Dashboard User (hanya untuk user login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi');
    Route::get('/presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
});

// Route Admin (hanya untuk admin)
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin Presensi
    Route::get('/admin/presensi', function () {
        return view('admin.presensi');
    })->name('admin.presensi');

    // Admin Kantor
    Route::get('/admin/kantor', function () {
        return view('admin.office.kantor');
    })->name('admin.kantor');
    Route::get('admin/office/create', [KantorController::class, 'create'])->name('admin.office.create');
    Route::get('/admin/office', [KantorController::class, 'index'])->name('admin.office.index');

    // Admin Pengguna
    Route::get('/admin/pengguna', function () {
        return view('admin.user.pengguna');
    })->name('admin.pengguna');
    Route::get('admin/user/create', [PenggunaController::class, 'create'])->name('admin.user.create');
});
