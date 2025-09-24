<?php

namespace App\Filament\Resources\ProgramPembangunanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangRelationManager extends RelationManager
{
    protected static string $relationship = 'barang';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_barang')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_barang')
            ->columns([
                Tables\Columns\TextColumn::make('nama_barang'),
                TextColumn::make('jumlah_barang')
                    ->label('Jumlah Barang'),
                TextColumn::make('status')
                    ->label('Status')
                    ->description('Barang Sudah Tersedia Digudang')
                    ->badge()
                    ->color(
                        fn (string $state): string => match ($state){
                            'tersedia' => 'success',
                            'diambil' => 'danger'
                        }
                    )
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Tambah Barang')
                    ->icon('heroicon-o-plus-circle')
                    ->color('warning')
                    ->form(fn (AttachAction $action) => [
                        $action->getRecordSelect(),
                        TextInput::make('jumlah_barang')
                            ->numeric(),
                        Hidden::make('status')
                            ->default('tersedia'),
                        TextInput::make('keterangan')
                            ->required(),
                    ]),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
