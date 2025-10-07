<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengeluaranResource\Pages;
use App\Filament\Resources\PengeluaranResource\RelationManagers;
use App\Models\Pengeluaran;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengeluaranResource extends Resource
{
    protected static ?string $model = Pengeluaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pengeluaran';

    protected static ?string $pluralLabel = 'Pengeluaran';

    protected static ?string $label = 'Pengeluaran';

    protected static ?string $navigationGroup = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal')->label('Tanggal Pembelian')->required(),
                Select::make('kategori')->label('Kategori Pengeluaran')->required()
                    ->options([
                        'Material' => 'Pembelian Material',
                        'Upah' => 'Upah Tenaga Kerja',
                        'Sewa' => 'Sewa Peralatan',
                        'Jasa' => 'Jasa Professional / Subkontraktor',
                        'Transportasi' => 'Transportasi & Logistik',
                        'Perizinan' => 'Perizinan & Administrasi',
                        'Operasional' => 'Operasional Lapangan',
                        'Platform' => 'Biaya Platform & Transaksi',
                        'Pemasaran' => 'Pemasaran & Promosi',
                        'Lain - Lain' => 'Lain - Lain / Tak Terduga',
                    ]),
                RichEditor::make('deskripsi')->label('Deskripsi Pengeluaran')->required(),
                TextInput::make('jumlah')->label('Jumlah Pengeluaran')->required()->prefix('Rp.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')->date('d m Y')->label('Tanggal Pembelian'),
                TextColumn::make('kategori')->label('Kategori Pengeluaran'),
                TextColumn::make('deskripsi')->label('Deskripsi Pengeluaran'),
                TextColumn::make('jumlah')->money('IDR')->label('Jumlah Pengeluaran')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListPengeluarans::route('/'),
            'create' => Pages\CreatePengeluaran::route('/create'),
            'edit' => Pages\EditPengeluaran::route('/{record}/edit'),
        ];
    }
}
