<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDonasiSpesifikResource\Pages;
use App\Models\m_metode_pembayaran;
use App\Models\t_kebutuhan_barang_program;
use App\Models\t_transaksi_donasi_spesifik;
use Dom\Text;
use Dvarilek\FilamentTableSelect\Components\Form\TableSelect;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
                                ->placeholder('Masukkan Barang Donasi')
                                ->optionIcon('heroicon-o-archive-box')
                                ->selectionTable(function (Table $table) {
                                    return $table
                                        ->heading('Pilih Barang')
                                        ->columns([
                                            TextColumn::make('barang.nama_barang')->label('Nama Barang'),
                                            TextColumn::make('jumlah_barang')->label('Jumlah Barang'),
                                            TextColumn::make('status')->label('status')->badge(),
                                            TextColumn::make('program.nama_pembangunan')->label('Nama Program')->searchable()
                                        ])
                                        ->modifyQueryUsing(function ($query) {
                                            return $query->with(['barang','program'])->where('status','tersedia')->where('status_pembelian','tersedia');
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
                                }), //melakukan perubahan didalam FrontEnd (tampilan), dan menyimpankan datakedalam kolom tersebut
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
                TextColumn::make('user.datadiri.nama_lengkap')
                    ->label('Nama Donatur')
                    ->sortable(),
                TextColumn::make('kebutuhan.barang.nama_barang')
                    ->label('Nama Barang')
                    ->badge(),
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
            ])
            ->filters([
                SelectFilter::make('program')
                    ->relationship('program','nama_pembangunan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('ACC')
                    ->label('Validasi Bukti Pembayaran')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record): bool => $record->status_kirim_bukti_pembayaran === 'sudah' && $record->status_pembayaran === 'pending' && auth()->user()->hasRole(['super_admin','admin']))
                    ->modalHeading('Detail dan Validasi Pembayaran')
                    ->modalWidth('3xl')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->modalCancelActionLabel('Konfirmasi / ACC')
                    ->infolist([
                        Section::make('Program')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('program.nama_pembangunan')
                                    ->label('Nama Pembangunan'),
                                TextEntry::make('program.kode_pembangunan')
                                    ->label('Kode Pembangunan'),
                            ]),
                        Section::make('Pengguna')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Username'),
                                TextEntry::make('user.email')
                                    ->label('E - Mail'),
                                TextEntry::make('user.datadiri.nama_lengkap')
                                    ->label('Nama Lengkap'),
                                TextEntry::make('user.datadiri.no_telp')
                                    ->label('Nomor Telefon'),
                            ]),
                        Section::make('Pembayaran')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('pembayaran.nama_pembayaran')
                                    ->label('Nama Pembayaran'),
                                TextEntry::make('pembayaran.no_rekening')
                                    ->label('Nomor Rekening')
                                    ->badge()
                                    ->copyable(),
                                TextEntry::make('jumlah_donasi')
                                    ->money('IDR'),
                                TextEntry::make('status_pembayaran')
                                    ->label('Status Pembayaran')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state){
                                        'gagal' => 'danger',
                                        'pending' => 'warning',
                                        'sukses' => 'success',
                                    }),
                                TextEntry::make('pesan_donatur')
                                    ->label('Pesan'),
                                SpatieMediaLibraryImageEntry::make('bukti_pembayaran')
                                    ->label('Bukti Pembayaran')
                                    ->collection('bukti_pembayaran_spesifik')
                        ]),
                        Section::make('Tabel Barang')
                            ->schema([
                                ViewEntry::make('kebutuhanBarang')
                                    ->label('')
                                    ->view('filament.infolist.kebutuhan-barang-tabel')    
                        ])
                    ])
                    ->modalFooterActions(fn ($record) => [
                            Action::make('tolak')
                                ->label('Tolak')
                                ->color('danger')
                                ->requiresConfirmation()
                                ->form([
                                    Textarea::make('alasan_penolakan')
                                        ->label('Alasan Penolakan')
                                        ->required()
                                ])
                                ->action(function (array $data) use ($record){
                                    $record->status_pembayaran = 'gagal';
                                    $record->alasan_penolakan = $data['alasan_penolakan'];
                                    $record->save();
                                }),
                            Action::make('setujui')
                                ->label('Seujui (ACC)')
                                ->color('success')
                                ->requiresConfirmation()
                                ->action(function () use ($record){
                                    $record->status_pembayaran = 'sukses';
                                    $record->save();
                                })
                        ])
                    ,
                Action::make('bayar')
                    ->label('Bayar Sekarang')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->color('primary')
                    ->visible(fn ($record): bool => $record->status_pembayaran === "pending" && auth()->user()->hasRole('user'))
                    ->modalHeading('Upload Bukti Pembayaran')
                    ->modalSubmitActionLabel('Upload')
                    ->form([
                        \Filament\Forms\Components\ViewField::make('no_rekening')
                            ->view('filament.custom.no_rekening')
                            ->label('No Rekening'),
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('bukti_pembayaran')
                            ->label('Bukti Pembayaran (JPG/PNG)')
                            ->collection('bukti_pembayaran_spesifik')
                            ->image()
                            ->imageEditor()
                            ->required(),
                    ])
                    ->action(function ($record){
                        $record->status_kirim_bukti_pembayaran = 'sudah';
                        $record->save();
                    }),
                ViewAction::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->visible(fn($record): bool => $record->status_pembayaran !== "pending" && auth()->user()->hasRole('user'))
                    ->modalHeading('Detail Donasi')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(static::getInfolistSchema());
    }

    public static function getInfolistSchema(): array
    {
        return [
            Section::make('Pembayaran')
                ->columns(2)
                ->schema([
                    TextEntry::make('pembayaran.nama_pembayaran')
                        ->label('Nama Pembayaran'),
                    TextEntry::make('pembayaran.no_rekening')
                        ->label('Nomor Rekening')
                        ->badge()
                        ->copyable(),
                    TextEntry::make('jumlah_donasi')
                        ->money('IDR'),
                    TextEntry::make('status_pembayaran')
                        ->label('Status Pembayaran')
                        ->badge()
                        ->color(fn (string $state): string => match ($state){
                            'gagal' => 'danger',
                            'pending' => 'warning',
                            'sukses' => 'success',
                        }),
                    TextEntry::make('pesan_donatur')
                        ->label('Pesan'),
                    SpatieMediaLibraryImageEntry::make('bukti_pembayaran')
                        ->label('Bukti Pembayaran')
                        ->collection('bukti_pembayaran_spesifik')
                ]),
            Section::make('Tabel Barang')
                ->schema([
                    ViewEntry::make('kebutuhanBarang')
                        ->label('')
                        ->view('filament.infolist.kebutuhan-barang-tabel')    
                ])
        ];
    }

    public static function getEloquentQuery(): EloquentBuilder
    {
        $query = parent::getEloquentQuery();

        $user = Auth::user();

        if(!$user->hasRole('Admin')){
            $query->where('user_id', $user->id);
        }

        return $query;
    }

}
