<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDonasiProgramResource\Pages;
use App\Filament\Resources\TransaksiDonasiProgramResource\RelationManagers;
use App\Models\m_program_pembangunan;
use App\Models\t_transaksi_donasi_program;
use App\Models\TransaksiDonasiProgram;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiDonasiProgramResource extends Resource
{
    protected static ?string $model = t_transaksi_donasi_program::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Data Transaksi Donasi Program';

    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
{
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Program')
                        ->schema([
                            Forms\Components\Select::make('program_id')
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
                                ->relationship('pembayaran','nama_pembayaran')
                                ->label('Pilih Pembayaran'),
                            TextInput::make('jumlah_donasi')
                                ->required()
                                ->prefix('Rp.')
                                ->label('Jumlah Donasi'),
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
                TextColumn::make('user.datadiri.nama_lengkap')
                    ->label('Nama Donatur')
                    ->sortable(),
                TextColumn::make('program.nama_pembangunan')
                    ->label('Nama Program Pembangunan')
                    ->sortable(),
                TextColumn::make('jumlah_donasi')
                    ->label('Jumlah Donasi'),
                TextColumn::make('status_pembayaran')
                    ->label('Status Pemabayaran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state){
                        'gagal' => 'danger',
                        'pending' => 'warning',
                        'sukses' => 'success',
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTransaksiDonasiPrograms::route('/'),
            'create' => Pages\CreateTransaksiDonasiProgram::route('/create'),
            'edit' => Pages\EditTransaksiDonasiProgram::route('/{record}/edit'),
        ];
    }
}
