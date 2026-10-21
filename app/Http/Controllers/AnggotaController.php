<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnggotaExport;

class AnggotaController extends Controller
{
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
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        Anggota::create($data);

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
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        $anggota->update($data);

        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(Anggota $anggota)
    {
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }
        Anggota::destroy($anggota->id);
        return redirect()->route($this->getRoutePrefix() . 'index')->with('success', 'Data anggota berhasil dihapus!');
    }

    public function buatAkun(Anggota $anggota)
    {
        if ($anggota->user_id) {
            return redirect()->back()->with('error', 'Anggota ini sudah memiliki akun login.');
        }

        $roleAnggota = \App\Models\Role::where('slug', 'anggota')->first();
        
        $user = User::create([
            'nama' => $anggota->nama,
            'email' => strtolower(str_replace(' ', '', $anggota->nama)) . '@harjuna.id',
            'password' => Hash::make('password123'),
            'role_id' => $roleAnggota->id,
            'is_aktif' => 1,
        ]);

        $anggota->update(['user_id' => $user->id]);

        return redirect()->back()->with('success', 'Akun berhasil dibuat! Email: ' . $user->email . ' | Password: password123');
    }

    public function resetPassword(Anggota $anggota)
    {
        if (!$anggota->user_id) {
            return redirect()->back()->with('error', 'Anggota ini belum memiliki akun.');
        }

        $user = User::find($anggota->user_id);
        $user->update([
            'password' => Hash::make('password123')
        ]);

        return redirect()->back()->with('success', 'Password berhasil direset menjadi: password123');
    }
            public function ekspor()
    {
        return Excel::download(new AnggotaExport, 'Data_Anggota_RW06_' . date('Y-m-d') . '.xlsx');
    }
}