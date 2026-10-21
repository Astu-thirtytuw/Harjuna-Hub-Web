<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IuranController;

// ==========================================
// 1. HALAMAN PUBLIK (Warga / Tanpa Login)
// ==========================================

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/berita/{slug}', [BerandaController::class, 'detailBerita'])->name('berita.detail');
Route::get('/profil', [BerandaController::class, 'profil'])->name('profil');
Route::get('/kegiatan', [BerandaController::class, 'semuaKegiatan'])->name('kegiatan.publik');
Route::get('/berita', [BerandaController::class, 'semuaBerita'])->name('berita.publik');

Route::post('/lapor-warga', [PelayananController::class, 'store'])->name('pelayanan.store');
Route::match(['get', 'post'], '/cek-laporan', [BerandaController::class, 'cekLaporan'])->name('cek.laporan');

// ==========================================
// 2. REDIRECT SETELAH LOGIN
// ==========================================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


// ==========================================
// 3. GROUP ROUTE PER ROLE (Admin/Pengurus)
// ==========================================

// --- KETUA & WAKIL ---
Route::middleware(['auth', 'role:ketua,wakil'])
    ->prefix('ketua')
    ->name('dashboard.ketua.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'ketua'])->name('index');
        
        Route::resource('anggota', AnggotaController::class)
             ->parameters(['anggota' => 'anggota'])
             ->names([
                 'index' => 'anggota.index',       
                 'create' => 'anggota.create',     
                 'store' => 'anggota.store',       
                 'edit' => 'anggota.edit',         
                 'update' => 'anggota.update',     
                 'destroy' => 'anggota.destroy',   
             ]);

        Route::resource('keuangan', KeuanganController::class)
             ->only(['index', 'create', 'store', 'destroy'])
             ->parameters(['keuangan' => 'id']) 
             ->names([
                 'index' => 'keuangan.index', 'create' => 'keuangan.create', 
                 'store' => 'keuangan.store', 'destroy' => 'keuangan.destroy',
             ]);

        Route::get('pelayanan', [PelayananController::class, 'index'])->name('pelayanan.index');
        Route::put('pelayanan/{pelayanan}', [PelayananController::class, 'update'])->name('pelayanan.update');

        Route::resource('pengumuman', PengumumanController::class)
                ->only(['index', 'create', 'store', 'destroy'])
                ->parameters(['pengumuman' => 'pengumuman'])
                ->names([
                    'index' => 'pengumuman.index', 'create' => 'pengumuman.create', 
                    'store' => 'pengumuman.store', 'destroy' => 'pengumuman.destroy',
                ]);

        Route::resource('kegiatan', KegiatanController::class)
            ->only(['index', 'create', 'store', 'destroy'])
            ->parameters(['kegiatan' => 'kegiatan'])
            ->names([
                'index' => 'kegiatan.index', 'create' => 'kegiatan.create', 
                'store' => 'kegiatan.store', 'destroy' => 'kegiatan.destroy',
            ]);

        Route::get('anggota/{anggota}/buat-akun', [AnggotaController::class, 'buatAkun'])->name('anggota.buatAkun');
        Route::get('anggota/ekspor/csv', [AnggotaController::class, 'ekspor'])->name('anggota.ekspor');
        Route::get('anggota/{anggota}/reset-password', [AnggotaController::class, 'resetPassword'])->name('anggota.resetPassword');

        Route::get('iuran', [IuranController::class, 'index'])->name('iuran.index');
        Route::post('iuran', [IuranController::class, 'store'])->name('iuran.store');
        Route::get('anggota/ekspor/csv', [AnggotaController::class, 'ekspor'])->name('anggota.ekspor');
    
    });


// --- SEKRETARIS ---
Route::middleware(['auth', 'role:sekretaris,ketua'])
    ->prefix('sekretaris')
    ->name('dashboard.sekretaris.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'sekretaris'])->name('index');
        
        Route::resource('anggota', AnggotaController::class)
             ->parameters(['anggota' => 'anggota'])
             ->names([
                 'index' => 'anggota.index',       
                 'create' => 'anggota.create',     
                 'store' => 'anggota.store',       
                 'edit' => 'anggota.edit',         
                 'update' => 'anggota.update',     
                 'destroy' => 'anggota.destroy',   
             ]);
             
        Route::get('pelayanan', [PelayananController::class, 'index'])->name('pelayanan.index');
        Route::put('pelayanan/{pelayanan}', [PelayananController::class, 'update'])->name('pelayanan.update');

        Route::resource('pengumuman', PengumumanController::class)
                ->only(['index', 'create', 'store', 'destroy'])
                ->parameters(['pengumuman' => 'pengumuman'])
                ->names([
                    'index' => 'pengumuman.index', 'create' => 'pengumuman.create', 
                    'store' => 'pengumuman.store', 'destroy' => 'pengumuman.destroy',
                ]);

        Route::resource('kegiatan', KegiatanController::class)
             ->only(['index', 'create', 'store', 'destroy'])
             ->parameters(['kegiatan' => 'kegiatan'])
             ->names([
                 'index' => 'kegiatan.index', 'create' => 'kegiatan.create', 
                 'store' => 'kegiatan.store', 'destroy' => 'kegiatan.destroy',
             ]);

        Route::get('anggota/{anggota}/buat-akun', [AnggotaController::class, 'buatAkun'])->name('anggota.buatAkun');
        Route::get('anggota/{anggota}/reset-password', [AnggotaController::class, 'resetPassword'])->name('anggota.resetPassword');
        Route::get('anggota/ekspor/csv', [AnggotaController::class, 'ekspor'])->name('anggota.ekspor');
    });


// --- BENDAHARA ---
Route::middleware(['auth', 'role:bendahara,ketua'])
    ->prefix('bendahara')
    ->name('dashboard.bendahara.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'bendahara'])->name('index');

        Route::resource('keuangan', KeuanganController::class)
             ->only(['index', 'create', 'store', 'destroy'])
             ->parameters(['keuangan' => 'id'])
             ->names([
                 'index' => 'keuangan.index', 'create' => 'keuangan.create', 
                 'store' => 'keuangan.store', 'destroy' => 'keuangan.destroy',
             ]);
        Route::get('iuran', [IuranController::class, 'index'])->name('iuran.index');
        Route::post('iuran', [IuranController::class, 'store'])->name('iuran.store');     
    });


// --- KORBID ---
Route::middleware(['auth', 'role:korbid,ketua'])
    ->prefix('korbid')
    ->name('dashboard.korbid.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'korbid'])->name('index');
        
        Route::resource('kegiatan', KegiatanController::class)
             ->only(['index', 'create', 'store', 'destroy'])
             ->parameters(['kegiatan' => 'kegiatan'])
             ->names([
                 'index' => 'kegiatan.index', 'create' => 'kegiatan.create', 
                 'store' => 'kegiatan.store', 'destroy' => 'kegiatan.destroy',
             ]);
    });


// --- ANGGOTA ---
Route::middleware(['auth', 'role:anggota,korbid,sekretaris,bendahara,ketua'])
    ->prefix('anggota')
    ->name('dashboard.anggota.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'anggota'])->name('index');
    });


// ==========================================
// 4. PROFILE BAWAAN BREEZE
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';