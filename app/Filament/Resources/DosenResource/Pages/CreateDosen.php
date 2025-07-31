<?php

namespace App\Filament\Resources\DosenResource\Pages;

use App\Filament\Resources\DosenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDosen extends CreateRecord
{
    protected static string $resource = DosenResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $tahun = now()->year;
        $count = \App\Models\Dosen::whereYear('created_at', $tahun)->count() + 1;
        $data['nip'] = "DSN{$tahun}" . str_pad($count, 3, '0', STR_PAD_LEFT);
        return $data;
    }
}
