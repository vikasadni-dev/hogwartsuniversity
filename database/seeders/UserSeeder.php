<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan roles sudah ada
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $dosenRole = Role::firstOrCreate(['name' => 'Dosen']);
        $mahasiswaRole = Role::firstOrCreate(['name' => 'Mahasiswa']);

        // Buat user Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole($adminRole);

        // Buat user Dosen
        $dosen = User::firstOrCreate(
            ['email' => 'dosen@example.com'],
            ['name' => 'Dosen', 'password' => bcrypt('password')]
        );
        $dosen->assignRole($dosenRole);

        // Buat user Mahasiswa
        $mahasiswa = User::firstOrCreate(
            ['email' => 'mahasiswa@example.com'],
            ['name' => 'Mahasiswa', 'password' => bcrypt('password')]
        );
        $mahasiswa->assignRole($mahasiswaRole);
    }
}
