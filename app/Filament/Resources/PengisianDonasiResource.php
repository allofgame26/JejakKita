<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengisianDonasiResource\Pages;
use App\Filament\Resources\PengisianDonasiResource\RelationManagers;
use App\Models\m_program_pembangunan;
use App\Models\PengisianDonasi;
use App\Models\t_pengisian_donasi;
use App\Models\t_transaksi_donasi_program;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PengisianDonasiResource extends Resource
{
    protected static ?string $model = t_transaksi_donasi_program::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Pengisian Donasi';

    protected static ?string $label = 'Pengisian Donasi';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $slug = 'pengisian-donasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
                Hidden::make('program_id')
                    ->default(function () {
                        $topPriorityProgram = m_program_pembangunan::where('status_pendanaan','belum_lengkap')->orderBy('skor_prioritas_akhir','desc')->first();

                        return $topPriorityProgram ? $topPriorityProgram->id : null;
                    }),
                Hidden::make('status_pembayaran')
                    ->default('pending'),
                Forms\Components\Select::make('pembayaran_id')
                    ->label('Metode Pembayaran')
                    ->relationship('pembayaran', 'nama_pembayaran')
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih metode pembayaran')
                    // ->helperText('Pilih metode pembayaran yang tersedia.')
                    ->prefixIcon('heroicon-o-credit-card')
                    ->required(),
                Forms\Components\TextInput::make('jumlah_donasi')
                    ->label('Jumlah Donasi')
                    ->numeric()
                    ->prefix('Rp')
                    ->placeholder('0')
                    // ->helperText('Masukkan nominal donasi dalam rupiah.')
                    ->required(),
                Forms\Components\Textarea::make('pesan_donatur')
                    ->label('Pesan Donatur')
                    ->placeholder('Tulis pesan atau harapan Anda (opsional)')
                    ->rows(3)
                // ->helperText('Pesan ini akan diterima oleh pengelola program.'),
                // membuat Program automatis dipilih untuk masuk kedalam donasi
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Nama Lengkap Donatur')
                    ->searchable()
                    ->icon('heroicon-o-user'),
                Tables\Columns\TextColumn::make('pembayaran.nama_pembayaran')
                    ->label('Metode Pembayaran')
                    ->searchable()
                    ->icon('heroicon-o-credit-card'),
                Tables\Columns\TextColumn::make('jumlah_donasi')
                    ->label('Jumlah Donasi')
                    ->money('IDR', true)
                    ->color('success'),
                Tables\Columns\TextColumn::make('pesan_donatur')
                    ->label('Pesan Donatur')
                    ->limit(30)
                    ->icon('heroicon-o-chat-bubble-left-ellipsis'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengisian')
                    ->dateTime('d M Y H:i')
                    ->icon('heroicon-o-calendar-days'),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('bayar')
                    ->label('Bayar Sekarang')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->color('primary')
                    ->visible(fn ($record): bool => $record->status_pembayaran === "pending")
                    ->modalHeading('Upload Bukti Pembayaran')
                    ->modalSubmitActionLabel('Upload')
                    ->form([
                        \Filament\Forms\Components\ViewField::make('no_rekening')
                            ->view('filament.custom.no_rekening')
                            ->label('No Rekening'),
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('bukti_pembayaran')
                            ->label('Bukti Pembayaran (JPG/PNG)')
                            ->collection('bukti_pembayaran_pengisian_lansia')
                            ->image()
                            ->imageEditor()
                            ->required(),
                    ])
                    ->action(function ($record) {
                        $record->status_pembayaran = 'sukses';
                        $record->save();
                    })
                    ,
                \Filament\Tables\Actions\Action::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->visible(fn($record): bool => $record->status_pembayaran !== "pending")
                    ->modalHeading('Detail Donasi')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->modalContent(fn($record) => view('filament.custom.detail-donasi', ['record' => $record])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPengisianDonasis::route('/'),
            'create' => Pages\CreatePengisianDonasi::route('/create'),
            // 'edit' => Pages\EditPengisianDonasi::route('/{record}/edit'),
        ];
    }
}