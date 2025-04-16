<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['idUser' => '1234567'], // idUser custom
            [
                'name' => 'Admin',
                'alamat' => 'Kampus Pusat',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
                'prodi_idProdi' => 1,
                'role_idRole' => 4
            ]
        );
    }
}
