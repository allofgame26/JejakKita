<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDonasiProgramResource\Pages;
use App\Filament\Resources\TransaksiDonasiProgramResource\RelationManagers;
use App\Models\m_metode_pembayaran;
use App\Models\m_program_pembangunan;
use App\Models\t_transaksi_donasi_program;
use App\Models\TransaksiDonasiProgram;
use App\Models\User;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TransaksiDonasiProgramResource extends Resource
{
    protected static ?string $model = t_transaksi_donasi_program::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Data Transaksi Donasi Program';

    protected static ?string $pluralLabel = 'Data Transaksi Donasi Program';

    protected static ?string $label = 'Data Transaksi Donasi Program';

    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
{
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Program')
                        ->schema([
                            Select::make('program_id')
                                ->required()
                                ->relationship('program','nama_pembangunan', modifyQueryUsing: fn (Builder $query) => $query->where('status_pendanaan', 'lengkap'))
                                ->label('Pilih Program')
                                ->reactive()
                                ->live(),
                            Hidden::make('user_id')
                                ->default(fn ()=> auth()->id()),
                            Hidden::make('status_pembayaran')
                                ->default('pending')
                        ])->columns(2),
                    Step::make('Pembayaran')
                        ->schema([
                            Select::make('pembayaran_id')
                                ->required()
                                ->preload()
                                ->relationship('pembayaran','nama_pembayaran')
                                ->options(m_metode_pembayaran::where('is_open', true)->pluck('nama_pembayaran','id'))
                                ->label('Pilih Pembayaran'),
                            TextInput::make('jumlah_donasi')
                                ->required()
                                ->prefix('Rp.')
                                ->label('Jumlah Donasi')
                                ->numeric(),
                            TextInput::make('pesan_donatur')
                                ->label('Pesan Donatur')
                        ])->columns(2)
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('user.datadiri.nama_lengkap')
                    ->label('Nama Donatur')
                    ->sortable(),
                TextColumn::make('program.nama_pembangunan')
                    ->label('Nama Program Pembangunan')
                    ->sortable(),
                TextColumn::make('jumlah_donasi')
                    ->label('Jumlah Donasi')
                    ->money('IDR',true)
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
                    ->collection('bukti_pembayaran_transaksi_program')
            ])
            ->filters([
                SelectFilter::make('pembayaran')
                    ->relationship('pembayaran','nama_pembayaran'),
                SelectFilter::make('program')
                    ->relationship('program','nama_pembangunan')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('ACC')
                    ->label('Valiadsi Bukti Pembayaran')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record): bool => $record->status_kirim_bukti_pembayaran === "sudah" && $record->status_pembayaran === 'pending' && auth()->user()->hasRole(['super_admin','Admin']))
                    ->modalHeading('Pembayaran Transaksi')
                    ->modalSubmitActionLabel('Konfirmasi / ACC')
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
                                    ->label('Jumlah Donasi')
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
                                    ->label('Pesan Donatur'),
                                SpatieMediaLibraryImageEntry::make('bukti_pembayaran')
                                    ->collection('bukti_pembayaran_transaksi_program')
                                    ->label('Bukti Pembayaran')
                            ]),
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
                        ]),
                Action::make('bayar')
                    ->label('Bayar Sekarang')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->color('primary')
                    ->visible(fn ($record): bool => $record->status_pembayaran === "pending" && $record->status_kirim_bukti_pembayaran === 'belum' && auth()->user()->hasRole('user'))
                    ->modalHeading('Upload Bukti Pembayaran')
                    ->modalSubmitActionLabel('Upload')
                    ->form([
                        \Filament\Forms\Components\ViewField::make('no_rekening')
                            ->view('filament.custom.no_rekening')
                            ->label('No Rekening'),
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('bukti_pembayaran')
                            ->label('Bukti Pembayaran (JPG/PNG)')
                            ->collection('bukti_pembayaran_transaksi_program')
                            ->image()
                            ->imageEditor()
                            ->required(),
                    ])
                    ->action(function ($record){
                        $record->status_kirim_bukti_pembayaran = 'sudah';
                        $record->save();

                        $admins = User::role(['Admin','super_admin'])->get();

                        Notification::make()
                            ->title('Transaksi Baru, Menunggu Validasi')
                            ->body('Donasi Sejumlah ' . number_format($record->jumlah_donasi, 0, ',', '.') . " dari {$record->user->name} perlu divalidasi")
                            ->icon('heroicon-o-currency-dollar')
                            ->actions([
                                NotificationAction::make('view')
                                    ->label('Lihat & Validasi Transaksi')
                                    ->url(route('filament.admin.resources.transaksi-donasi-programs.index'))
                            ])
                            ->sendToDatabase($admins);
                    }),
                ViewAction::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->visible(fn($record): bool => $record->status_pembayaran !== "pending" && auth()->user()->hasRole('user'))
                    ->modalHeading('Detail Donasi')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
                Action::make('download')
                    ->label('Download Kwitansi')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn ($record) => route('kwitansiProgram.download', ['transaksi' => $record]))
                    ->openUrlInNewTab()
                    ->visible(fn ($record): bool => $record->status_pembayaran === 'sukses'),
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
                ])->visible(fn ():bool => auth()->user()->hasRole(['Admin','super_admin'])),
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
            'index' => Pages\ListTransaksiDonasiPrograms::route('/'),
            'create' => Pages\CreateTransaksiDonasiProgram::route('/create'),
            'edit' => Pages\EditTransaksiDonasiProgram::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(static::getInfolistSchema());
    }

    public static function getInfolistSchema(): array
    {
        return [
            Section::make('Nama Program')
                ->columns(2)
                ->schema([
                    TextEntry::make('program.nama_pembangunan')
                        ->label('Nama Pembangunan'),
                    TextEntry::make('program.estimasi_tanggal_selesai')
                        ->label('Estimasi Tanggal Selesai')
                        ->date('d M Y'),
                    TextEntry::make('program.periode.nama_periode')
                        ->label('Periode'),
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
                        ->label('Jumlah Donasi')
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
                        ->label('Pesan Donatur'),
                    SpatieMediaLibraryImageEntry::make('bukti_pembayaran')
                        ->collection('bukti_pembayaran_transaksi_program')
                        ->label('Bukti Pembayaran')
                ]),
            

        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = Auth::user();

        if(!$user->hasRole(['Admin','super_admin'])){
            $query->where('user_id', $user->id);
        }

        return $query;
    }
}
