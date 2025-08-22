<?php

namespace App\Filament\Resources\ProgramPembangunanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PriorityRelationManager extends RelationManager
{
    protected static string $relationship = 'priority';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_priority')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_priority')
            ->description('NOTE: Cek persen dari prioritas agar 100%, jika tidak akan error')
            ->columns([
                Tables\Columns\TextColumn::make('nama_priority'),
                TextColumn::make('nilai_priority')
                    ->numeric()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Tambah Prioritas')
                    ->icon('heroicon-o-plus-circle')
                    ->color('warning')
                    ->form(fn (AttachAction $action) => [
                        $action->getRecordSelect(),
                        TextInput::make('nilai_priority')
                            ->numeric()
                            ->minValue(0)
                            ->minValue(5)
                            ->prefixIcon('heroicon-o-percent-badge')
                    ])
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                DetachAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
