<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MataKuliahResource\Pages;
use App\Filament\Resources\MataKuliahResource\RelationManagers;
use App\Models\MataKuliah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;



class MataKuliahResource extends Resource
{
    protected static ?string $model = MataKuliah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('nama')->required()->label('Nama Mata Kuliah'),
            TextInput::make('kode')->required()->label('Kode'),
            TextInput::make('sks')->numeric()->required(),
            TextInput::make('semester')->numeric()->required(),
            Select::make('jurusan_id')
                ->label('Jurusan')
                ->relationship('jurusan', 'nama')
                ->required(),
            Select::make('dosen_id')
            ->label('Dosen Pengampu')
            ->relationship('dosen', 'nama')
            ->required(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('kode')->label('Kode'),
            TextColumn::make('nama')->label('Nama Mata Kuliah'),
            TextColumn::make('sks'),
            TextColumn::make('semester'),
            TextColumn::make('jurusan.nama')->label('Jurusan'),
            TextColumn::make('dosen.nama')->label('Dosen Pengampu'),
        ])
        ->filters([
            SelectFilter::make('jurusan_id')
                ->label('Filter Jurusan')
                ->relationship('jurusan', 'nama'),
            SelectFilter::make('dosen_id')
                ->label('Filter Dosen Pengampu')
                ->relationship('dosen', 'nama'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMataKuliahs::route('/'),
            'create' => Pages\CreateMataKuliah::route('/create'),
            'edit' => Pages\EditMataKuliah::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['Admin', 'Dosen', 'Mahasiswa']);
    }
    
    public static function canView(Model $record): bool
    {
        $user = auth()->user();
        if ($user->hasRole('Admin')) return true;
        if ($user->hasRole('Dosen')) {
            return $record->dosen_id === $user->id;
        }
            if ($user->hasRole('Mahasiswa')) {
                return true; // Hanya lihat (opsional)
                }
                return false;
            }
            
    public static function canEdit(Model $record): bool
    {
        $user = auth()->user();
        if ($user->hasRole('Admin')) return true;
        if ($user->hasRole('Dosen')) {
            return $record->dosen_id === $user->id;
        }
        return false;
    }
    
    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole('Admin'); // hanya admin
        }
}
