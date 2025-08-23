<?php

namespace App\Filament\Resources\ProgramPembangunanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
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
                    ->modalIcon('heroicon-o-exclamation-triangle')
                    ->modalDescription('Beri Nilai Retang 1 - 5')
                    ->preloadRecordSelect()
                    ->label('Tambah Prioritas')
                    ->icon('heroicon-o-plus-circle')
                    ->color('warning')
                    ->form(fn (AttachAction $action) => [
                        Fieldset::make('Nilai')
                            ->schema([
                                $action->getRecordSelect(),
                                Radio::make('nilai_priority')
                                    ->label('Beri Nilai Skor')
                                    ->options([
                                        '1' => '1 - Sangat Rendah',
                                        '2' => '2 - Rendah',
                                        '3' => '3 - Sedang',
                                        '4' => '4 - Tinggi',
                                        '5' => '5 - Sangat Tinggi',
                                    ])
                                    ->descriptions([
                                        '1' => 'Dampak atau urgensi sangat kecil, bisa ditunda tanpa risiko.',
                                        '2' => 'Dampak atau urgensi rendah, tidak terlalu signifikan.',
                                        '3' => 'Dampak atau urgensi cukup, standar atau netral.',
                                        '4' => 'Dampak atau urgensi besar dan penting untuk diperhatikan.',
                                        '5' => 'Dampak atau urgensi sangat kritis, harus segera ditangani.',
                                    ])
                                ->required()
                            ])->columns(1)
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
