<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Budi Santoso', 'jenis_kelamin' => 'L', 'divisi_id' => 1, 'jabatan' => 'Ketua'],
            ['nama' => 'Siti Aminah',  'jenis_kelamin' => 'P', 'divisi_id' => 2, 'jabatan' => 'Sekretaris'],
            ['nama' => 'Joko Widodo',  'jenis_kelamin' => 'L', 'divisi_id' => 3, 'jabatan' => 'Bendahara'],
            ['nama' => 'Dewi Lestari', 'jenis_kelamin' => 'P', 'divisi_id' => 1, 'jabatan' => 'Anggota'],
            ['nama' => 'Ahmad Fauzi',  'jenis_kelamin' => 'L', 'divisi_id' => 4, 'jabatan' => 'Anggota'],
        ];

        foreach ($data as $i => $row) {
            $nik = '33010101010100' . str_pad($i + 1, 2, '0', STR_PAD_LEFT);

            Anggota::updateOrCreate(
                ['nik' => $nik],   // kunci unik
                array_merge($row, [
                    'alamat' => 'Jl. Merdeka No. ' . ($i + 1),
                    'rt' => '01',
                    'rw' => '02',
                    'no_hp' => '0812345678' . $i,
                    'status' => 'aktif',
                    'tanggal_gabung' => now(),
                ])
            );
        }
    }
}