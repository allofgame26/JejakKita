<?php

namespace App\Filament\Resources\BarangResource\RelationManagers;

use App\Models\m_vendor;
use App\Models\t_transaksi_barang;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiBarangRelationManager extends RelationManager
{
    protected static string $relationship = 'transaksiBarang';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('vendor_id')
                    ->label('Nama Vendor')
                    ->options(m_vendor::where('status', 'aktif')->pluck('nama_vendor', 'id'))
                    ->searchable()
                    ->required(),
                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('vendor_id')
            ->columns([
                Tables\Columns\TextColumn::make('vendor.nama_vendor')
                    ->label('Nama Vendor')
                    ->icon('heroicon-o-user-circle')
                    ->searchable(),
                TextColumn::make('jumlah_dibeli')
                    ->label('Jumlah Dibeli')
                    ->badge(),
                TextColumn::make('vendor.alamat_vendor')
                    ->label('Alamat Vendor')
                    ->icon('heroicon-o-building-storefront'),
                TextColumn::make('vendor.no_telepon')
                    ->label('Nomor Telepon')
                    ->icon('heroicon-o-phone'),
                TextColumn::make('tanggal_beli')
                    ->date('d M Y'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Transaksi Barang')
                    ->icon('heroicon-o-plus-circle')
                    ->modalHeading('Catat Pembelian Barang')
                    ->color('warning')
                    ->form([
                        Select::make('vendor_id')
                            ->relationship('vendor', 'nama_vendor')
                            ->label('Pilih Vendor')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('kode_vendor')
                                    ->label('Kode Vendor')
                                    ->required(),
                                TextInput::make('nama_vendor')
                                    ->label('Nama Vendor')
                                    ->required(),
                                TextInput::make('alamat_vendor')
                                    ->label('Alamat Vendor')
                                    ->required(),
                                TextInput::make('no_telepon')
                                    ->label('Nomor Telepon / WhatsApp')
                                    ->required(),
                                TextInput::make('keterangan')
                                    ->label('Keterangan'),
                                Hidden::make('status')
                                    ->default('aktif')
                                ])
                                ->createOptionUsing(function (array $data): int {
                                    $newVendor = m_vendor::create($data);

                                    return $newVendor->id;
                                }),
                        TextInput::make('jumlah_dibeli')
                            ->numeric()
                            ->label('Jumlah Dibeli')
                            ->required(),
                        TextInput::make('harga_satuan')
                            ->numeric()
                            ->label('Harga Satuan')
                            ->required(),
                        DatePicker::make('tanggal_beli')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->label('Tanggal Pembelian')
                            ->maxDate(now())
                            ->required(),
                        Hidden::make('status_pembayaran')
                            ->default('pending')
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('bayar')
                    ->label('Pengumpulan Struk')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->color('primary')
                    ->visible(fn ($record): bool => $record->status_pembayaran === 'pending')
                    ->modalHeading('Upload Bukti Pembayaran')
                    ->modalSubmitActionLabel('Upload')
                    ->form([
                        SpatieMediaLibraryFileUpload::make('bukti_pembayaran')
                            ->label('Nota Pembayaran')
                            ->collection('pembelian_barang')
                            ->image()
                            ->imageEditor()
                            ->required()
                    ])
                    ->action(function (array $data, $record){

                        $record->status_pembayaran = 'berhasil';
                        $record->save();

                    }),
                ViewAction::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->visible(fn ($record): bool => $record->status_pembayaran !== 'pending')    
                    ->modalHeading('Detail Pembelian Barang')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('tutup')
                    ->infolist([
                        Fieldset::make('vendor')
                            ->label('Vendor')
                            ->schema([
                                TextEntry::make('nama_vendor')
                                    ->label('Nama Vendor')
                                    ->icon('heroicon-o-building-storefront'),
                                TextEntry::make('alamat_vendor')
                                    ->label('Alamat Vendor')
                                    ->icon('heroicon-o-building-storefront'),
                            ])
                            ->columns(2),
                        Fieldset::make('Transaksi Pembelian')
                            ->label('Transaksi Pembelian')
                            ->schema([
                                TextEntry::make('pivot.jumlah_dibeli')
                                    ->label('Jumlah Dibeli')
                                    ->badge(),
                                TextEntry::make('pivot.harga_satuan')
                                    ->label('Harga Satuan')
                                    ->badge(),
                                TextEntry::make('pivot.tanggal_beli')
                                    ->label('Tanggal Pembelian')
                                    ->date('d M Y'),
                                TextEntry::make('pivot.status_pembayaran')
                                    ->label('Status Pembayaran')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state){
                                        'pending' => 'warning',
                                        'berhasil' => 'success',
                                        'gagal' => 'danger',
                                    }),
                                SpatieMediaLibraryImageEntry::make('bukti_pembayaran')
                                    ->label('Bukti Pembayaran')
                                    ->collection('pembelian_barang')
                                    ->visible(fn ($record) => $record->pivot->status_pembayaran === 'berhasil'),
                            ])
                            ->columns(2)
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
