<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            ['idRole' => 1, 'role_name' => 'Mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['idRole' => 2, 'role_name' => 'Kaprodi', 'created_at' => now(), 'updated_at' => now()],
            ['idRole' => 3, 'role_name' => 'TU', 'created_at' => now(), 'updated_at' => now()],
            ['idRole' => 4, 'role_name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
