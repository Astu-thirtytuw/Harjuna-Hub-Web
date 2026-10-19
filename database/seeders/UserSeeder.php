<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $ketuaId = DB::table('roles')->where('slug', 'ketua')->value('id');
        $sekretarisId = DB::table('roles')->where('slug', 'sekretaris')->value('id');
        $bendaharaId = DB::table('roles')->where('slug', 'bendahara')->value('id');
        $anggotaId = DB::table('roles')->where('slug', 'anggota')->value('id');

        DB::table('users')->insert([
            [
                'nama' => 'Admin Ketua',
                'email' => 'ketua@harjuna.id',
                'password' => Hash::make('password'),
                'role_id' => $ketuaId,
                'is_aktif' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Admin Sekretaris',
                'email' => 'sekretaris@harjuna.id',
                'password' => Hash::make('password'),
                'role_id' => $sekretarisId,
                'is_aktif' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Admin Bendahara',
                'email' => 'bendahara@harjuna.id',
                'password' => Hash::make('password'),
                'role_id' => $bendaharaId,
                'is_aktif' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Anggota Demo',
                'email' => 'anggota@harjuna.id',
                'password' => Hash::make('password'),
                'role_id' => $anggotaId,
                'is_aktif' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}