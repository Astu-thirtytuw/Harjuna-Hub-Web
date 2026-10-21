<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Anggota;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    public function index()
    {
        // Ambil semua data iuran beserta nama anggotanya
        $iuran = Iuran::with('anggota')->latest('tahun')->latest('bulan')->paginate(10);
        $anggota = Anggota::where('status', 'aktif')->get(); // Untuk form tambah
        
        return view('iuran.index', compact('iuran', 'anggota'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020',
            'jumlah' => 'required|numeric|min:0',
            // 'status' tidak perlu divalidasi dari form lagi karena akan diatur otomatis
        ]);

        // LOGIKA OTOMATIS:
        // Jika jumlah yang dibayar >= 10.000, maka Lunas. Jika kurang, maka Sebagian.
        $status = $request->jumlah >= 10000 ? 'lunas' : 'sebagian';

        Iuran::updateOrCreate(
            [
                'anggota_id' => $request->anggota_id,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
            ],
            [
                'jumlah' => $request->jumlah,
                'status' => $status, // <-- Status otomatis dari sistem
                'tanggal_bayar' => $status == 'lunas' ? now() : null,
                'diterima_oleh' => auth()->id(),
            ]
        );

        return redirect()->back()->with('success', 'Data Kas Anggota berhasil disimpan!');
    }
}