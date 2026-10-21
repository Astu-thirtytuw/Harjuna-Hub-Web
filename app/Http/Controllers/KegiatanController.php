<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    private function getRoutePrefix()
    {
        // Bisa diakses oleh Sekretaris & Korbid (dan Ketua)
        if (auth()->user()->hasRole('ketua')) {
            return 'dashboard.ketua.kegiatan.';
        } elseif (auth()->user()->hasRole('korbid')) {
            return 'dashboard.korbid.kegiatan.';
        }
        return 'dashboard.sekretaris.kegiatan.';
    }

    public function index()
    {
        $kegiatan = Kegiatan::with('divisi')->latest('tanggal_mulai')->paginate(10);
        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        $divisi = Divisi::all();
        return view('kegiatan.create', compact('divisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'waktu_mulai' => 'nullable',
            'lokasi' => 'nullable|string|max:255',
            'divisi_id' => 'required|exists:divisi,id',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:draft,publish,selesai,batal',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama) . '-' . Str::random(5);
        $data['is_publik'] = $request->has('is_publik') ? true : false;

        Kegiatan::create($data);

        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Kegiatan berhasil dihapus!');
    }
}