<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Filament\Resources\BarangResource\RelationManagers\VendorRelationManager;
use App\Models\m_barang;
use App\Models\t_kebutuhan_barang_program;
use App\Models\t_transaksi_barang;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                    ->icon('heroicon-o-clipboard-document-list'),
                TextColumn::make('kategoribarang.nama_kategori')
                    ->label('Nama Kategori')
                    ->icon('heroicon-o-archive-box'),
                TextColumn::make('nama_barang')
                    ->label('Nama Barang')
                    ->icon('heroicon-o-gift'),
                TextColumn::make('barang_inventory')
                    ->getStateUsing(function ($record){
                        $cekJumlahBarang = t_transaksi_barang::where('barang_id',$record->id)->where('status_pembayaran','berhasil')->sum('jumlah_dibeli');
                        $cekJumlahPemakaian = t_kebutuhan_barang_program::where('barang_id',$record->id && 'status' === 'diambil')->sum('jumlah_barang');

                        $inventory = $cekJumlahBarang - $cekJumlahPemakaian;

                        return $inventory;
                    })
                    ->badge()
                    ->color(function ($state){
                        if($state < 0 ){
                             return 'danger';
                        } elseif($state > 0) {
                            return 'success';
                        } else {
                            return 'warning';
                        }
                    })
                // TextColumn::make('total_harga')
                //     ->label('Total Harga')
                //     ->getStateUsing(fn ($record) => 
                //         'Rp. ' . number_format($record->jumlah_barang_dibutuhkan * $record->harga_satuan, 0, ',', '.')),
            ])
            ->filters([
                SelectFilter::make('kategoriBarang.nama_kategori')
                    ->relationship('kategoriBarang','nama_kategori')
                    ->preload()
                    ->searchable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
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
            VendorRelationManager::class
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
