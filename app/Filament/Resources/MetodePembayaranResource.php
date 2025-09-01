<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MetodePembayaranResource\Pages;
use App\Filament\Resources\MetodePembayaranResource\RelationManagers;
use App\Models\m_metode_pembayaran;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MetodePembayaranResource extends Resource
{
    protected static ?string $model = m_metode_pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Metode Pembayaran';

    protected static ?string $pluralLabel = 'Metode Pembayaran';

    protected static ?string $label = 'Metode Pembayaran';

    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_pembayaran')
                    ->label('Nama Pembayaran')
                    ->required(),
                TextInput::make('no_rekening')
                    ->label('Nomor Rekenening')
                    ->required()
                    ->unique(ignoreRecord: TRUE)
                    ->validationMessages([
                        'unique' => 'Nomor Rekening sudah ada'
                    ]),
                Toggle::make('is_open')
                    ->label('Active')
                    ->onColor('success')
                    ->offColor('danger'),
                TextInput::make('deskripsi')
                    ->label('Deskripsi')
                        ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pembayaran')
                    ->label('Nama Pembayaran')
                    ->sortable(),
                ToggleColumn::make('is_open')
                    ->label('Active')
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->label('Detail')
                ->icon('heroicon-o-eye')
                ->modalHeading('Detail Metode Pembayaran')
                ->modalContent(fn ($record) => view('filament.resources.metode-pembayaran-detail', [
                    'record' => $record
                ])),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMetodePembayarans::route('/'),
            'create' => Pages\CreateMetodePembayaran::route('/create'),
            'edit' => Pages\EditMetodePembayaran::route('/{record}/edit'),
        ];
    }
}
