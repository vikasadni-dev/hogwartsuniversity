<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Models\Mahasiswa;
use Filament\Forms\Components\{TextInput, Select, DatePicker, Textarea};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\{TextColumn, SelectColumn};
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Mahasiswa';
    protected static ?string $pluralModelLabel = 'Data Mahasiswa';
    protected static ?string $navigationGroup = 'Akademik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->maxLength(100)
                    ->required(),

                TextInput::make('email')
                    ->email()
                    ->required(),

                Select::make('asrama')
                    ->options([
                        'Gryffindor' => 'Gryffindor',
                        'Hufflepuff' => 'Hufflepuff',
                        'Ravenclaw' => 'Ravenclaw',
                        'Slytherin' => 'Slytherin',
                    ])
                    ->required(),

                Select::make('jenis_kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),

                DatePicker::make('tanggal_lahir')
                    ->required(),

                Textarea::make('alamat')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nim')->label('NIM')->sortable()->searchable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('email')->sortable(),
                TextColumn::make('asrama'),
                TextColumn::make('jenis_kelamin')->label('Jenis Kelamin'),
                TextColumn::make('tanggal_lahir')->date(),
            ])
            ->filters([
                SelectFilter::make('asrama')
                ->label('Filter Asrama')
                ->options([
                    'Gryffindor' => 'Gryffindor',
                    'Hufflepuff' => 'Hufflepuff',
                    'Ravenclaw' => 'Ravenclaw',
                    'Slytherin' => 'Slytherin',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}

