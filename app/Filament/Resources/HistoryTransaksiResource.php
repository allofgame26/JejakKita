<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryTransaksiResource\Pages;
use App\Filament\Resources\HistoryTransaksiResource\RelationManagers;
use App\Models\HistoryTransaksi;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class HistoryTransaksiResource extends Resource
{
    protected static ?string $model = HistoryTransaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'History Transaksi';

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
                TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.datadiri.nama_lengkap')
                    ->label('Nama Donatur')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kode_transaksi')
                    ->label('Kode Transaksi')
                    ->searchable(),
                BadgeColumn::make('jenis_transaksi') // Tampilkan jenis transaksi dengan badge
                    ->colors([
                        'primary' => 'Program',
                        'success' => 'Spesifik',
                    ])
                    ->searchable(),
                TextColumn::make('deskripsi')
                    ->label('Deskripsi'),
                TextColumn::make('jumlah_donasi')
                    ->money('IDR')
                    ->sortable(),
                BadgeColumn::make('status_pembayaran')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'sukses',
                        'danger' => 'gagal',
                    ])
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status_pembayaran')
                    ->options([
                        'gagal' => 'Gagal',
                        'pending' => 'Pending',
                        'sukses' => 'Sukses',
                    ])->multiple()
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
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
