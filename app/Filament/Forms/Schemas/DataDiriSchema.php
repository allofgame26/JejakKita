<?php

namespace App\Filament\Forms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class DataDiriSchema
{
    /**
     * Mengembalikan array skema form untuk data diri.
     *
     * @return array
     */
    public static function getSchema(): array
    {
        return [
            TextInput::make('nama_lengkap')
                    ->required()
                    ->label('Nama Lengkap'),
            TextInput::make('alamat')
                    ->label('Alamat lengkap')
                    ->required(),
            Select::make('jenis_kelamin')
                    ->options([
                        'laki' => 'Laki - Laki',
                        'perempuan' => 'Perempuan'
                    ])
                    ->required(),
            TextInput::make('no_telp')
                    ->required()
                    ->unique(ignoreRecord: false),
            SpatieMediaLibraryFileUpload::make('Foto Profil')
                    ->required()
                    ->label('Foto Profil')
                    ->image()->imageEditor()
                    ->collection('fotoProfil')
                    ->conversion('compressed')
                    ->maxSize(2048)
                    ->helperText('Ukuran maksimum file adalah 2MB.'),
        ];
    }
}