<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Keuangan;
use App\Models\Pelayanan;
use App\Models\Pengumuman;
use App\Models\Iuran;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return match ($user->role->slug) {
            'ketua', 'wakil' => redirect()->route('dashboard.ketua.index'),
            'sekretaris'     => redirect()->route('dashboard.sekretaris.index'),
            'bendahara'      => redirect()->route('dashboard.bendahara.index'),
            'korbid'         => redirect()->route('dashboard.korbid.index'),
            'anggota'        => redirect()->route('dashboard.anggota.index'),
            default          => abort(403),
        };
    }

    // Fungsi bantuan untuk mengambil statistik
    private function getStats()
    {
        return [
            'total_anggota' => Anggota::where('status', 'aktif')->count(),
            'total_laporan_baru' => Pelayanan::where('status', 'baru')->count(),
            'total_kas' => Keuangan::where('jenis', 'masuk')->sum('jumlah') - Keuangan::where('jenis', 'keluar')->sum('jumlah'),
            'total_pengumuman' => Pengumuman::where('is_publik', true)->count(),
        ];
    }

    public function ketua()      
    { 
        $stats = $this->getStats();
        return view('dashboard.ketua', compact('stats')); 
    }

    public function sekretaris() 
    { 
        $stats = $this->getStats();
        return view('dashboard.sekretaris', compact('stats')); 
    }

    public function bendahara()  
    { 
        $stats = $this->getStats();
        return view('dashboard.bendahara', compact('stats')); 
    }

    public function korbid()     
    { 
        return view('dashboard.korbid'); 
    }

    public function anggota()    
    { 
        $user = auth()->user();
        $anggota = $user->anggota;
        
        $iuran = collect();
        if ($anggota) {
            $iuran = Iuran::where('anggota_id', $anggota->id)
                          ->orderBy('tahun', 'desc')
                          ->orderBy('bulan', 'desc')
                          ->get();
        }

        return view('dashboard.anggota', compact('anggota', 'iuran')); 
    }
}