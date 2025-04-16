<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodi')->insertOrIgnore([
            ['idProdi' => 1, 'nama_prodi' => 'Teknik Informatika', 'created_at' => now(), 'updated_at' => now()],
            ['idProdi' => 2, 'nama_prodi' => 'Sistem Informasi', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
