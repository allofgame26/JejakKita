<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrioritasResource\Pages;
use App\Filament\Resources\PrioritasResource\RelationManagers;
use App\Models\Prioritas;
use App\Models\Priority;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrioritasResource extends Resource
{
    protected static ?string $model = Priority::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationLabel = 'Pengaturan Prioritas Pembangunan';

    protected static ?string $pluralLabel = 'Pengaturan Prioritas Pembangunan';

    protected static ?string $label = 'Pengaturan Prioritas Pembangunan';

    protected static ?string $navigationGroup = 'Pembangunan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_priority')
                    ->required()
                    ->label('Nama Variabel Prioritas'),
                TextInput::make('persen_priority')
                    ->required()
                    ->label('Persen')
                    ->suffixIcon('heroicon-o-percent-badge'),
                TextInput::make('deskripsi_priority')
                    ->required()
                    ->label('Deskripsi Prioritas')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_prioritas')
                    ->label('Nama Prioritas')
                    ->icon('heroicon-o-book-open'),
                TextColumn::make('persen_priority')
                    ->label('Besar Priority')
                    ->icon('heroicon-o-percent-badge')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePrioritas::route('/'),
        ];
    }
}
