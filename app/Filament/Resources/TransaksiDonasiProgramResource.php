<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDonasiProgramResource\Pages;
use App\Filament\Resources\TransaksiDonasiProgramResource\RelationManagers;
use App\Models\m_metode_pembayaran;
use App\Models\m_program_pembangunan;
use App\Models\t_transaksi_donasi_program;
use App\Models\TransaksiDonasiProgram;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                                ->relationship('program','nama_pembangunan')
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
                ])
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
                TextColumn::make('user.email')
                    ->label('E-mail Donatur')
                    ->sortable(),
                TextColumn::make('program.nama_pembangunan')
                    ->label('Nama Program Pembangunan')
                    ->sortable(),
                TextColumn::make('jumlah_donasi')
                    ->label('Jumlah Donasi')
                    ->money('IDR')
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
                SelectFilter::make('pembayaran')
                    ->relationship('pembayaran','nama_pembayaran'),
                SelectFilter::make('program')
                    ->relationship('program','nama_pembangunan')
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
            'index' => Pages\ListTransaksiDonasiPrograms::route('/'),
            'create' => Pages\CreateTransaksiDonasiProgram::route('/create'),
            'edit' => Pages\EditTransaksiDonasiProgram::route('/{record}/edit'),
        ];
    }
}
