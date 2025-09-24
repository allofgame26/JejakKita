<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ViewKwitansiDigitalResource\Pages;
use App\Filament\Resources\ViewKwitansiDigitalResource\RelationManagers;
use App\Models\t_pengisian_donasi;
use App\Models\ViewKwitansiDigital;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ViewKwitansiDigitalResource extends Resource
{
    protected static ?string $model = t_pengisian_donasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Kwitansi Digital';

    protected static ?string $label = 'Kwitansi Digital';

    protected static ?string $navigationGroup = 'Donasi';

    protected static ?string $slug = 'kwitansi-digital';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
                    ->limit(30)
                    ->icon('heroicon-o-chat-bubble-left-ellipsis'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengisian')
                    ->dateTime('d M Y H:i')
                    ->icon('heroicon-o-calendar-days'),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('created_at', '<=', $data['until']));
                    }),
                Tables\Filters\Filter::make('jumlah_donasi')
                    ->form([
                        Forms\Components\TextInput::make('min')->label('Min Donasi')->numeric(),
                        Forms\Components\TextInput::make('max')->label('Max Donasi')->numeric(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['min'], fn($q) => $q->where('jumlah_donasi', '>=', $data['min']))
                            ->when($data['max'], fn($q) => $q->where('jumlah_donasi', '<=', $data['max']));
                    }),
            ])
            ->actions([
                // \Filament\Tables\Actions\Action::make('bayar')
                //     ->label('Bayar Sekarang')
                //     ->icon('heroicon-o-arrow-up-on-square')
                //     ->color('primary')
                //     ->visible(fn($record) => $record->pembayaran_id && !$record->bukti_pembayaran)
                //     ->modalHeading('Upload Bukti Pembayaran')
                //     ->modalSubmitActionLabel('Upload')
                //     ->form([
                //         \Filament\Forms\Components\ViewField::make('no_rekening')
                //             ->view('filament.custom.no_rekening')
                //             ->label('No Rekening'),
                //         \Filament\Forms\Components\FileUpload::make('bukti_pembayaran')
                //             ->label('Bukti Pembayaran (JPG/PNG/PDF)')
                //             ->image()
                //             ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
                //             ->maxSize(2048)
                //             ->required(),
                //     ])
                //     ->action(function ($record, array $data) {
                //         $record->bukti_pembayaran = $data['bukti_pembayaran'];
                //         $record->save();
                //     }),
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
            ])
            ->headerActions([]); // 
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
            'index' => Pages\ListViewKwitansiDigitals::route('/'),
            // 'create' => Pages\CreateViewKwitansiDigital::route('/create'),
            // 'edit' => Pages\EditViewKwitansiDigital::route('/{record}/edit'),
        ];
    }
}
