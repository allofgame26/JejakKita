<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ViewDonasiProgramResource\Pages;
use App\Filament\Resources\ViewDonasiProgramResource\RelationManagers;
use App\Models\m_program_pembangunan;
use App\Models\ViewDonasiProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ViewDonasiProgramResource extends Resource
{
    protected static ?string $model = m_program_pembangunan::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Program Pembangunan';

    protected static ?string $label = 'Program Pembangunan';

    protected static ?string $navigationGroup = 'Donasi';

    protected static ?string $slug = 'program-pembangunan';

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
            'index' => Pages\ListViewDonasiPrograms::route('/'),
            'create' => Pages\CreateViewDonasiProgram::route('/create'),
            'edit' => Pages\EditViewDonasiProgram::route('/{record}/edit'),
        ];
    }
}
