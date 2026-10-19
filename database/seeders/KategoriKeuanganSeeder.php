<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class KategoriKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_keuangan')->insert([
            ['nama' => 'Iuran Anggota', 'jenis' => 'masuk',  'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Donasi',        'jenis' => 'masuk',  'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Dana Desa',     'jenis' => 'masuk',  'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Konsumsi',      'jenis' => 'keluar', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'ATK',           'jenis' => 'keluar', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Perlengkapan',  'jenis' => 'keluar', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sosial',        'jenis' => 'keluar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
