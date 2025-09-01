<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryResource\Pages;
use App\Models\t_transaksi_donasi_program;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HistoryResource extends Resource
{
    protected static ?string $model = t_transaksi_donasi_program::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'History Donasi';
    protected static ?string $label = 'History';
    protected static ?string $navigationGroup = 'Donasi';
    protected static ?string $slug = 'history';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nama Donatur')->searchable(),
                Tables\Columns\TextColumn::make('jumlah_donasi')->label('Jumlah Donasi')->searchable(),
                Tables\Columns\TextColumn::make('status_pembayaran')->label('Status'),
                Tables\Columns\TextColumn::make('pesan_donatur')->label('Pesan'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
            ->filters([
                //
            ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            // ])
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
            'index' => Pages\ListHistories::route('/'),
            // 'create' => Pages\CreateHistory::route('/create'),
            // 'edit' => Pages\EditHistory::route('/{record}/edit'),
        ];
    }
}