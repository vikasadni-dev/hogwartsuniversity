<?php

use Illuminate\Support\Facades\Route;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

Route::get('/convert-mahasiswa-to-user', function () {
    $mahasiswaList = Mahasiswa::all();
    $role = Role::firstOrCreate(['name' => 'Mahasiswa']);
    $created = 0;

    foreach ($mahasiswaList as $mhs) {
        $existingUser = User::where('email', $mhs->email)->first();

        if (!$existingUser) {
            $user = User::create([
                'name' => $mhs->nama,
                'email' => $mhs->email,
                'password' => Hash::make('password'), // default password
            ]);

            $user->assignRole('Mahasiswa');
            $created++;
        }
    }

    return "Berhasil membuat $created akun user dari data mahasiswa.";
});