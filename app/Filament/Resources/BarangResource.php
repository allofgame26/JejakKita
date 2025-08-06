<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\m_barang;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangResource extends Resource
{
    protected static ?string $model = m_barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    protected static ?string $navigationLabel = 'Data Barang';

    protected static ?string $navigationGroup = 'Pembangunan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_barang')
                    ->required()
                    ->label('Kode Barang'),
                Select::make('kategoribarang_id')
                    ->required()
                    ->relationship('kategoriBarang','nama_kategori'),
                TextInput::make('nama_barang')
                    ->required()
                    ->label('Nama Barang'),
                Select::make('nama_satuan')
                    ->required()
                    ->label('Nama Satuan')
                    ->options([
                        'unit' => 'Unit',
                        'batang' => 'Batang',
                        'lembar' => 'Lembar',
                        'meter_persegi' => 'Meter Persegi',
                        'meter_kubik' => 'Meter Kubik',
                        'kilogram' => 'Kilogram',
                        'sak' => 'Sak',
                        'roll' => 'Roll',
                        'paket' => 'Paket',
                    ]),
                TextInput::make('harga_satuan')
                    ->required()
                    ->numeric()
                    ->prefix('Rp.')
                    ->mask(RawJs::make('$money($input'))
                    ->stripCharacters(','),
                TextInput::make('jumlah_barang_dibutuhkan')
                    ->required()
                    ->numeric(),
                TextInput::make('deskripsi_barang')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_barang'),
                TextColumn::make('kategoribarang.nama_kategori'),
                TextColumn::make('nama_barang'),
                // TextColumn::make('total_harga')
                //     ->label('Total Harga')
                //     ->getStateUsing(fn ($record) => 
                //         'Rp. ' . number_format($record->jumlah_barang_dibutuhkan * $record->harga_satuan, 0, ',', '.')),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
