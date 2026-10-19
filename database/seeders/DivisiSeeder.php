<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisi')->insert([
            ['nama' => 'Acara',    'slug' => 'acara',    'deskripsi' => 'Perencanaan & pelaksanaan acara', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Humas',    'slug' => 'humas',    'deskripsi' => 'Hubungan masyarakat & publikasi',  'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sosial',   'slug' => 'sosial',   'deskripsi' => 'Kegiatan sosial & bakti',          'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Olahraga', 'slug' => 'olahraga', 'deskripsi' => 'Kegiatan olahraga & seni',         'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Keamanan', 'slug' => 'keamanan', 'deskripsi' => 'Ronda & kamtibmas',                'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
