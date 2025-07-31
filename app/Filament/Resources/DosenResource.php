<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DosenResource\Pages;
use App\Filament\Resources\DosenResource\RelationManagers;
use App\Models\Dosen;
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
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;


class DosenResource extends Resource
{
    protected static ?string $model = Dosen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
                TextInput::make('nama')
                    ->maxLength(100)
                    ->required(),

                TextInput::make('email')
                    ->email()
                    ->required(),

                Select::make('jenis_kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),

                DatePicker::make('tanggal_lahir')
                    ->required(),

                TextInput::make('departemen')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('nip')->label('NIP')->sortable()->searchable(),
            TextColumn::make('nama')->sortable()->searchable(),
            TextColumn::make('email')->sortable(),
            TextColumn::make('jenis_kelamin'),
            TextColumn::make('departemen')->sortable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('jenis_kelamin')
                ->options([
                    'Laki-laki' => 'Laki-laki',
                    'Perempuan' => 'Perempuan',
                    ])
                    ->label('Filter Jenis Kelamin'),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDosens::route('/'),
            'create' => Pages\CreateDosen::route('/create'),
            'edit' => Pages\EditDosen::route('/{record}/edit'),
        ];
    }

    public static function getPluralLabel(): string
    {
        return 'Dosen'; // Ubah jadi kata jamak yang kamu mau (misal: "Para Dosen")
    }

    public static function getLabel(): string
    {
        return 'Dosen'; // Ubah jadi kata tunggal yang kamu mau
    }
}
