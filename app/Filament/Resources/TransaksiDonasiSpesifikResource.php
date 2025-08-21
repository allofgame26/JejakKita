<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDonasiSpesifikResource\Pages;
use App\Models\m_metode_pembayaran;
use App\Models\t_kebutuhan_barang_program;
use App\Models\t_transaksi_donasi_spesifik;
use Dvarilek\FilamentTableSelect\Components\Form\TableSelect;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TransaksiDonasiSpesifikResource extends Resource
{
    protected static ?string $model = t_transaksi_donasi_spesifik::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Data Transaksi Spesifik Program';

    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Pilih Barang')
                        ->schema([
                            TableSelect::make('kebutuhan')
                                ->relationship('kebutuhan','id')
                                ->label('Kebutuhan Barang')
                                ->placeholder('Kebutuhan Barang')
                                ->optionColor('success')
                                ->selectionTable(function (Table $table) {
                                    return $table
                                        ->heading('Pilih Barang')
                                        ->columns([
                                            TextColumn::make('barang.nama_barang')->label('Nama Barang'),
                                            TextColumn::make('jumlah_barang')->label('Jumlah Barang'),
                                            TextColumn::make('status')->label('status')->badge(),
                                            TextColumn::make('program.nama_program')->label('Nama Program')->searchable()
                                        ])
                                        ->modifyQueryUsing(function ($query) {
                                            return $query->with('barang')->where('status','tersedia');
                                        });
                                    })
                                ->multiple()
                                ->required()
                                ->reactive()
                                ->getOptionLabelFromRecordUsing(fn ($record) => $record->barang->nama_barang ?? '-')
                                ->afterStateUpdated(function (callable $set, $state){
                                    $totaldonasi = t_kebutuhan_barang_program::with('barang')
                                        ->whereIn('id',$state)
                                        ->get()
                                        ->sum(function ($item){
                                            return $item->jumlah_barang * ($item->barang->harga_satuan ?? 0);
                                        });

                                    $set('jumlah_donasi',$totaldonasi);
                                }), //melakukan perubahan didalam FrontEnd, dan menyimpankan datakedalam kolom tersebut
                        ]),
                    Step::make('Pilih Pembayaran Pembayaran')
                        ->schema([
                            Hidden::make('user_id')
                                ->default(fn ()=> auth()->id()),
                            Hidden::make('status_pembayaran')
                                ->default('pending'),
                            Select::make('pembayaran_id')
                                ->required()
                                ->preload()
                                ->options(m_metode_pembayaran::where('is_open', true)->pluck('nama_pembayaran','id'))
                                ->label('Pilih Pembayaran'),
                            TextInput::make('jumlah_donasi')
                                ->prefix('Rp. ')
                                ->label("Jumlah Donasi")
                                ->disabled()
                                ->visible(fn ($get) => filled($get('kebutuhan')))
                                ->dehydrated(),
                            TextInput::make('pesan_donatur')
                                ->label('Pesan Donatur'),
                            
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->date('d M Y'),
                TextColumn::make('user.email')
                    ->label('E-mail Donatur')
                    ->sortable(),
                TextColumn::make('kebutuhan.barang.nama_barang')
                    ->label('Nama Barang'),
                TextColumn::make('jumlah_donasi')
                    ->label('Jumlah Donasi')
                    ->prefix('Rp.')
                    ->numeric(),
                TextColumn::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state){
                        'gagal' => 'danger',
                        'pending' => 'warning',
                        'sukses' => 'success',
                    }),
                SpatieMediaLibraryImageColumn::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->collection('bukti_pembayaran')
            ])
            ->filters([
                SelectFilter::make('program')
                    ->relationship('program','nama_pembangunan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('Sukses')
                        ->icon('heroicon-o-check-badge')
                        ->requiresConfirmation()
                        ->action(function (Collection $record) {
                            return $record->each->update(['status_pembayaran' => 'sukses']);
                        }),
                    BulkAction::make('Pending')
                        ->icon('heroicon-o-clock')
                        ->requiresConfirmation()
                        ->action(function (Collection $record) {
                            return $record->each->update(['status_pembayaran' => 'pending']);
                        }),
                    BulkAction::make('Gagal')
                        ->icon('heroicon-o-exclamation-triangle')
                        ->requiresConfirmation()
                        ->action(function (Collection $record) {
                            return $record->each->update(['status_pembayaran' => 'gagal']);
                        }),
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
            'index' => Pages\ListTransaksiDonasiSpesifiks::route('/'),
            'create' => Pages\CreateTransaksiDonasiSpesifik::route('/create'),
            'edit' => Pages\EditTransaksiDonasiSpesifik::route('/{record}/edit'),
        ];
    }

}
