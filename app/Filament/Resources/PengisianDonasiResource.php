<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengisianDonasiResource\Pages;
use App\Filament\Resources\PengisianDonasiResource\RelationManagers;
use App\Models\PengisianDonasi;
use App\Models\t_pengisian_donasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Tables\Columns\HtmlColumn;

class PengisianDonasiResource extends Resource
{
    protected static ?string $model = t_pengisian_donasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Pengisian Donasi';

    protected static ?string $label = 'Pengisian Donasi';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $slug = 'pengisian-donasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lengkap_donatur')
                    ->label('Nama Lengkap Donatur')
                    ->placeholder('Masukkan nama lengkap sesuai identitas')
                    // ->helperText('Pastikan nama sesuai dengan identitas untuk kemudahan verifikasi.')
                    ->prefixIcon('heroicon-o-user')
                    ->required(),
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
                TiptapEditor::make('pesan_donatur')
                    ->label('Pesan Donatur')
                    ->placeholder('Tulis pesan atau harapan Anda (opsional)')
                    ->columnSpanFull() // form field lebar penuh
                    ->extraAttributes([
                        'style' => 'max-height:10px; overflow-y:auto;'
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap_donatur')
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
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->limit(60)
                    ->html(),
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
                    ->visible(fn($record) => $record->pembayaran_id && !$record->bukti_pembayaran)
                    ->modalHeading('Upload Bukti Pembayaran')
                    ->modalSubmitActionLabel('Upload')
                    ->form([
                        \Filament\Forms\Components\ViewField::make('no_rekening')
                            ->view('filament.custom.no_rekening')
                            ->label('No Rekening'),
                        \Filament\Forms\Components\FileUpload::make('bukti_pembayaran')
                            ->label('Bukti Pembayaran (JPG/PNG/PDF)')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
                            ->maxSize(2048)
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->bukti_pembayaran = $data['bukti_pembayaran'];
                        $record->save();
                    }),
                \Filament\Tables\Actions\Action::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->visible(fn($record) => !empty($record->bukti_pembayaran))
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
