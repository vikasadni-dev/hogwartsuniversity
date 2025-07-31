<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use App\Filament\Resources\MahasiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class CreateMahasiswa extends CreateRecord
{
    protected static string $resource = MahasiswaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $prefix = strtoupper(substr($data['asrama'], 0, 1)); // G, H, R, S
        $tahun = now()->year;
        $count = \App\Models\Mahasiswa::whereYear('created_at', $tahun)->count() + 1;
        $urutan = str_pad($count, 3, '0', STR_PAD_LEFT);

        $data['nim'] = "ASR{$prefix}{$tahun}{$urutan}";

        return $data;
    }
    protected function afterCreate(): void
{
    $mahasiswa = $this->record;

    // Cek jika belum punya user
    if (!$mahasiswa->user_id) {
        $user = User::create([
            'name' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'password' => Hash::make('password123'), // password default
        ]);

        $user->assignRole('Mahasiswa');

        // Simpan relasi user ke mahasiswa
        $mahasiswa->user_id = $user->id;
        $mahasiswa->save();
    }
}

}