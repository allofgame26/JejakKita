<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DokumenResource\Pages;
use App\Filament\Resources\DokumenResource\RelationManagers;
use App\Models\m_dokumen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DokumenResource extends Resource
{
    protected static ?string $model = m_dokumen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Data Dokumen';

    protected static ?string $navigationGroup = 'Management Konten';

    protected static ?string $pluralLabel = 'Data Dokumen';

    protected static ?string $label = 'Data Dokumen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_dokumen')
                    ->label('Nama Dokumen')
                    ->required(),
                Forms\Components\Select::make('id_periode')
                    ->label('Periode')
                    ->relationship('periode', 'nama_periode')
                    ->required(),
                Forms\Components\FileUpload::make('file_path')
                    ->label('File Dokumen')
                    ->acceptedFileTypes(['application/pdf'])
                    ->required()
                    ->directory('public/dokumen'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_dokumen')->label('Nama Dokumen'),
                TextColumn::make('periode.nama_periode')->label('Periode'),
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
            'index' => Pages\ListDokumens::route('/'),
            'create' => Pages\CreateDokumen::route('/create'),
            'edit' => Pages\EditDokumen::route('/{record}/edit'),
        ];
    }
}
