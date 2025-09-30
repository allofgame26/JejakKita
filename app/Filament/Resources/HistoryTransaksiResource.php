<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryTransaksiResource\Pages;
use App\Filament\Resources\HistoryTransaksiResource\RelationManagers;
use App\Models\HistoryTransaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoryTransaksiResource extends Resource
{
    protected static ?string $model = HistoryTransaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'History Transaksi';

    protected static ?string $navigationGroup = 'Manajemen Donasi'; 

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
                TextColumn::make('created_at')
                ->label('Tanggal Transaksi')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->searchable(),
                TextColumn::make('user.name')
                    ->label('Nama Donatur')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make('jenis_transaksi') // Tampilkan jenis transaksi dengan badge
                    ->colors([
                        'primary' => 'Program',
                        'success' => 'Spesifik',
                    ])
                    ->searchable(),
                TextColumn::make('deskripsi')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('jumlah_donasi')
                    ->money('IDR')
                    ->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'completed',
                        'danger' => 'failed',
                    ])
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                ViewAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHistoryTransaksis::route('/'),
        ];
    }
}
