<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Redirect sesuai role
        return match ($user->role->slug) {
            'ketua', 'wakil' => redirect()->route('dashboard.ketua.index'),
            'sekretaris'     => redirect()->route('dashboard.sekretaris.index'),
            'bendahara'      => redirect()->route('dashboard.bendahara.index'),
            'korbid'         => redirect()->route('dashboard.korbid.index'),
            'anggota'        => redirect()->route('dashboard.anggota.index'),
            default          => abort(403),
        };
    }

    public function ketua()      { return view('dashboard.ketua'); }
    public function sekretaris() { return view('dashboard.sekretaris'); }
    public function bendahara()  { return view('dashboard.bendahara'); }
    public function korbid()     { return view('dashboard.korbid'); }
    public function anggota()    { return view('dashboard.anggota'); }
}