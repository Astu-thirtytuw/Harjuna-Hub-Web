<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Divisi;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    // Fungsi bantuan untuk menentukan prefix rute berdasarkan role
    private function getRoutePrefix()
    {
        return auth()->user()->hasRole('ketua') ? 'dashboard.ketua.anggota.' : 'dashboard.sekretaris.anggota.';
    }

    public function index()
    {
        $anggota = Anggota::with('divisi')->latest()->paginate(10);
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        $divisi = Divisi::all();
        return view('anggota.create', compact('divisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:20|unique:anggota,nik',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'divisi_id' => 'required|exists:divisi,id',
            'jabatan' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif,alumni',
            'tanggal_gabung' => 'required|date',
        ]);

        Anggota::create($request->all());

        // Gunakan getRoutePrefix() agar redirect-nya tepat sasaran
        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Data anggota berhasil ditambahkan!');
    }

    public function edit(Anggota $anggota)
    {
        $divisi = Divisi::all();
        return view('anggota.edit', compact('anggota', 'divisi'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:20|unique:anggota,nik,' . $anggota->id,
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'divisi_id' => 'required|exists:divisi,id',
            'jabatan' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif,alumni',
            'tanggal_gabung' => 'required|date',
        ]);

        $anggota->update($request->all());

        // Gunakan getRoutePrefix()
        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        
        // Gunakan getRoutePrefix()
        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Data anggota berhasil dihapus!');
    }
}