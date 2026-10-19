<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nama' => 'Ketua',        'slug' => 'ketua',       'deskripsi' => 'Pimpinan organisasi', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Wakil Ketua',  'slug' => 'wakil',       'deskripsi' => 'Wakil pimpinan',      'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sekretaris',   'slug' => 'sekretaris',  'deskripsi' => 'Administrasi & surat', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bendahara',    'slug' => 'bendahara',   'deskripsi' => 'Keuangan & kas',       'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Korbid',       'slug' => 'korbid',      'deskripsi' => 'Koordinator bidang',   'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Anggota',      'slug' => 'anggota',     'deskripsi' => 'Anggota aktif',        'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Warga',        'slug' => 'warga',       'deskripsi' => 'Masyarakat umum',      'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}