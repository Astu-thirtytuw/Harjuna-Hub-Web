<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PelayananController extends Controller
{
    // 1. Fungsi untuk warga mengirim laporan (Publik)
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'kategori' => 'required|in:infrastruktur,keamanan,kebersihan,sosial,usulan_kegiatan,lainnya',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
        ]);

        // Buat Kode Tiket unik, contoh: HRJ-2X9A
        $kode_tiket = 'HRJ-' . strtoupper(Str::random(4));

        Pelayanan::create([
            'kode_tiket' => $kode_tiket,
            'nama_pelapor' => $request->nama_pelapor,
            'no_hp' => $request->no_hp,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'status' => 'baru',
        ]);

        return redirect()->back()->with('success_tiket', $kode_tiket);
    }

    // 2. Fungsi untuk pengurus melihat daftar laporan (Admin)
    public function index()
    {
        $pelayanan = Pelayanan::latest()->paginate(10);
        return view('pelayanan.index', compact('pelayanan'));
    }

    // 3. Fungsi untuk pengurus mengubah status laporan
    public function update(Request $request, Pelayanan $pelayanan)
    {
        $request->validate([
            'status' => 'required|in:baru,diverifikasi,diproses,selesai,ditolak'
        ]);

        $pelayanan->update([
            'status' => $request->status,
            'ditangani_oleh' => auth()->id(),
            'ditangani_pada' => now(),
        ]);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui!');
    }
}