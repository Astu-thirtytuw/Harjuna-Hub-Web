<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    // Fungsi bantuan penentu rute
    private function getRoutePrefix()
    {
        return auth()->user()->hasRole('ketua') ? 'dashboard.ketua.pengumuman.' : 'dashboard.sekretaris.pengumuman.';
    }

    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:berita,pengumuman,artikel',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|max:2048', // Maks 2MB
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul) . '-' . Str::random(5);
        $data['penulis_id'] = auth()->id();
        
        // Jika disetujui untuk tampil di publik
        if ($request->has('is_publik')) {
            $data['is_publik'] = true;
            $data['published_at'] = now();
        } else {
            $data['is_publik'] = false;
        }

        // Upload Gambar (Jika ada)
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('images/pengumuman'), $namaGambar);
            $data['gambar'] = 'images/pengumuman/' . $namaGambar;
        }

        Pengumuman::create($data);

        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Pengumuman berhasil dibuat!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        // Hapus gambar dari folder jika ada
        if ($pengumuman->gambar && file_exists(public_path($pengumuman->gambar))) {
            unlink(public_path($pengumuman->gambar));
        }
        
        $pengumuman->delete();
        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Pengumuman berhasil dihapus!');
    }
}