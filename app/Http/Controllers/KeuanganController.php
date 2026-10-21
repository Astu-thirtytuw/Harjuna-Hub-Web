<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\KategoriKeuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    // Fungsi bantuan penentu rute (sama seperti di Anggota)
    private function getRoutePrefix()
    {
        return auth()->user()->hasRole('ketua') ? 'dashboard.ketua.keuangan.' : 'dashboard.bendahara.keuangan.';
    }

    public function index()
    {
        // Ambil semua data kas beserta kategorinya
        $keuangan = Keuangan::with('kategori')->latest('tanggal')->paginate(10);
        
        // Hitung total saldo
        $totalMasuk = Keuangan::where('jenis', 'masuk')->sum('jumlah');
        $totalKeluar = Keuangan::where('jenis', 'keluar')->sum('jumlah');
        $saldo = $totalMasuk - $totalKeluar;

        return view('keuangan.index', compact('keuangan', 'totalMasuk', 'totalKeluar', 'saldo'));
    }

    public function create()
    {
        $kategori = KategoriKeuangan::all();
        return view('keuangan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:masuk,keluar',
            'kategori_id' => 'required|exists:kategori_keuangan,id',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'sumber' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Tambahkan ID user yang mencatat
        $data = $request->all();
        $data['dicatat_oleh'] = auth()->id();

        Keuangan::create($data);

        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Transaksi berhasil dicatat!');
    }

    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();
        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Transaksi berhasil dihapus!');
    }
}