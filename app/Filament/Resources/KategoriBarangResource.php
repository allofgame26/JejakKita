<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriBarangResource\Pages;
use App\Filament\Resources\KategoriBarangResource\RelationManagers;
use App\Models\KategoriBarang;
use App\Models\m_kategori_barang;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriBarangResource extends Resource
{
    protected static ?string $model = m_kategori_barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'Data Kategori Barang';

    protected static ?string $navigationGroup = 'Pembangunan';

    protected static ?string $pluralLabel = 'Data Kategori Barang';

    protected static ?string $label = 'Data Kategori Barang';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_kategori')
                    ->unique(ignoreRecord: true)
                    ->label('Nama Kategori')
                    ->required(),
                TextInput::make('deskripsi_kategori')
                    ->label('Deskripsi Kategori')
                    ->maxLength(500)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kategori')
                    ->label('Nama Kategori'),
                TextColumn::make('deskripsi_kategori')
                    ->label('Deskripsi Kategori')
            ])
            ->filters([
                //
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
            'index' => Pages\ListKategoriBarangs::route('/'),
            'create' => Pages\CreateKategoriBarang::route('/create'),
            'edit' => Pages\EditKategoriBarang::route('/{record}/edit'),
        ];
    }
}
