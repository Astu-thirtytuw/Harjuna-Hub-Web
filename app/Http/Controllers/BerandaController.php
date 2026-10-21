<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Models\Kegiatan;

class BerandaController extends Controller
{
    // 1. Halaman Utama (Beranda)
   public function index()
    {
        $pengumuman = Pengumuman::where('is_publik', true)->latest('published_at')->take(3)->get();
        
        $kegiatan = \App\Models\Kegiatan::where('is_publik', true)
                    ->where('status', 'publish')
                    ->orderBy('tanggal_mulai', 'asc')
                    ->take(3)
                    ->get();

        // Ambil data statistik nyata dari database
        $total_anggota = \App\Models\Anggota::where('status', 'aktif')->count();
        $total_kegiatan = \App\Models\Kegiatan::count();
        $total_pengumuman = Pengumuman::where('is_publik', true)->count();

        return view('welcome', compact('pengumuman', 'kegiatan', 'total_anggota', 'total_kegiatan', 'total_pengumuman'));
    }

        // 2. Halaman Detail Berita
        public function detailBerita($slug)
        {
            $berita = Pengumuman::where('slug', $slug)->where('is_publik', true)->firstOrFail();
            return view('publik.detail-berita', compact('berita'));
        }

        // 3. Halaman Profil / Struktur Organisasi
            public function profil()
        {
            // Ambil Pengurus Inti (Ketua, Wakil, Sekretaris, Bendahara)
            $pengurusInti = Anggota::with('divisi')
                        ->whereIn('jabatan', ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'])
                        ->where('status', 'aktif')
                        ->get();

            // Ambil Koordinator Bidang (Korbid)
            $korbid = Anggota::with('divisi')
                        ->where('jabatan', 'Korbid')
                        ->where('status', 'aktif')
                        ->get();
                        
            return view('publik.profil', compact('pengurusInti', 'korbid'));
        }

        // Halaman Semua Kegiatan
    public function semuaKegiatan()
    {
        $kegiatan = \App\Models\Kegiatan::where('is_publik', true)
                    ->where('status', 'publish')
                    ->orderBy('tanggal_mulai', 'desc')
                    ->paginate(9);
        return view('publik.semua-kegiatan', compact('kegiatan'));
    }

    // Halaman Semua Berita
    public function semuaBerita()
    {
        $pengumuman = \App\Models\Pengumuman::where('is_publik', true)
                    ->latest('published_at')
                    ->paginate(9);
        return view('publik.semua-berita', compact('pengumuman'));
    }

            public function cekLaporan(Request $request)
    {
        $laporan = collect(); 
        $error = null;
        $search = null;

        if ($request->has('search')) {
            $search = $request->search;
            
            // Cari berdasarkan Kode Tiket ATAU Nomor HP
            $laporan = \App\Models\Pelayanan::where('kode_tiket', $search)
                        ->orWhere('no_hp', $search)
                        ->latest()
                        ->get();

            if ($laporan->isEmpty()) {
                $error = 'Data laporan tidak ditemukan. Pastikan Kode Tiket atau No HP sudah benar.';
            }
        }

        return view('publik.cek-laporan', compact('laporan', 'error', 'search'));
    }

}