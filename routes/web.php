<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::get('/', function () {
    return view('welcome');
})->name('beranda');

// Redirect setelah login → cek role
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// ====== GROUP ROUTE PER ROLE ======

/// Ketua & Wakil
Route::middleware(['auth', 'role:ketua,wakil'])
    ->prefix('ketua')
    ->name('dashboard.ketua.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'ketua'])->name('index');
        
        Route::resource('anggota', AnggotaController::class)
             ->names([
                 'index' => 'anggota.index',       
                 'create' => 'anggota.create',     
                 'store' => 'anggota.store',       
                 'edit' => 'anggota.edit',         
                 'update' => 'anggota.update',     
                 'destroy' => 'anggota.destroy',   
             ]);
    });

// Sekretaris
Route::middleware(['auth', 'role:sekretaris,ketua'])
    ->prefix('sekretaris')
    ->name('dashboard.sekretaris.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'sekretaris'])->name('index');
        
        Route::resource('anggota', AnggotaController::class)
             ->names([
                 'index' => 'anggota.index',       
                 'create' => 'anggota.create',     
                 'store' => 'anggota.store',       
                 'edit' => 'anggota.edit',         
                 'update' => 'anggota.update',     
                 'destroy' => 'anggota.destroy',   
             ]);
    });
// Bendahara
Route::middleware(['auth', 'role:bendahara,ketua'])
    ->prefix('bendahara')
    ->name('dashboard.bendahara.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'bendahara'])->name('index');
    });

// Korbid
Route::middleware(['auth', 'role:korbid,ketua'])
    ->prefix('korbid')
    ->name('dashboard.korbid.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'korbid'])->name('index');
    });

// Anggota
Route::middleware(['auth', 'role:anggota,korbid,sekretaris,bendahara,ketua'])
    ->prefix('anggota')
    ->name('dashboard.anggota.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'anggota'])->name('index');
    });

require __DIR__.'/auth.php';