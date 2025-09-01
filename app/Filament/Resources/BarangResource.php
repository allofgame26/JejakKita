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

    protected static ?string $navigationLabel = 'Daftar Barang';

    protected static ?string $navigationGroup = 'Pembangunan';

    protected static ?string $pluralLabel = 'Daftar Barang';

    protected static ?string $label = 'Daftar Barang'; 

    protected static ?string $slug = 'barangs';

    public static function form(Form $form): Form
    {
        return $form
                ->schema([
                    Forms\Components\Section::make([
                        TextInput::make('kode_barang')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('Kode Barang')
                            ->placeholder('Masukkan kode barang unik')
                            ->helperText('Kode barang harus unik.'),
                        Select::make('kategoribarang_id')
                            ->required()
                            ->relationship('kategoriBarang','nama_kategori')
                            ->preload()
                            ->searchable()
                            ->label('Kategori Barang')
                            ->placeholder('Pilih kategori barang'),
                        TextInput::make('nama_barang')
                            ->required()
                            ->label('Nama Barang')
                            ->placeholder('Masukkan nama barang'),
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
                            ])
                            ->selectablePlaceholder(condition: true),
                        TextInput::make('harga_satuan')
                            ->required()
                            ->numeric()
                            ->prefix('Rp.')
                            ->mask(RawJs::make('$money($input'))
                            ->stripCharacters(',')
                            ->placeholder('Masukkan harga satuan')
                            ->helperText('Harga satuan dalam Rupiah.'),
                        TextInput::make('deskripsi_barang')
                            ->required()
                            ->label('Deskripsi Barang')
                            ->placeholder('Deskripsi singkat barang'),
                    ])
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
                ->columns([
                    TextColumn::make('kode_barang')
                        ->label('Kode Barang')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->searchable()
                        ->sortable()
                        ->color('primary')
                        ->badge(),
                    TextColumn::make('kategoribarang.nama_kategori')
                        ->label('Nama Kategori')
                        ->icon('heroicon-o-archive-box')
                        ->searchable()
                        ->sortable()
                        ->color('success')
                        ->badge(),
                    TextColumn::make('nama_barang')
                        ->label('Nama Barang')
                        ->icon('heroicon-o-gift')
                        ->searchable()
                        ->sortable()
                        ->color('info')
                        ->badge(),
                ])
                ->filters([
                    Tables\Filters\SelectFilter::make('nama_barang')
                        ->label('Nama Barang Panjang'),
                    Tables\Filters\SelectFilter::make('kategoribarang_id')
                        ->label('Kategori Barang')
                        ->options(fn () => m_barang::pluck('kategoribarang_id', 'id')),
                ])
                ->actions([
                    Tables\Actions\ViewAction::make()
                        ->modalHeading('Detail Barang')
                        ->label('Detail')
                        ->modalContent(fn ($record) => view('filament.resources.barang-detail', [
                            'record' => $record
                        ])),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
