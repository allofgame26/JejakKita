<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDonasiSpesifikResource\Pages;
use App\Filament\Resources\TransaksiDonasiSpesifikResource\RelationManagers;
use App\Models\t_transaksi_donasi_spesifik;
use App\Models\TransaksiDonasiSpesifik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListTransaksiDonasiSpesifiks::route('/'),
            'create' => Pages\CreateTransaksiDonasiSpesifik::route('/create'),
            'edit' => Pages\EditTransaksiDonasiSpesifik::route('/{record}/edit'),
        ];
    }
}
