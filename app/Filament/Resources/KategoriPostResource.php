<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriPostResource\Pages;
use App\Filament\Resources\KategoriPostResource\RelationManagers;
use App\Models\KategoriPost;
use App\Models\m_kategori;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriPostResource extends Resource
{
    protected static ?string $model = m_kategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Data Kategori Post';

    protected static ?string $navigationGroup = 'Management Konten';

    protected static ?string $pluralLabel = 'Data Kategori Postingan';

    protected static ?string $label = 'Data Kategori Postingan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Nama Kategori')
                    ->required()
                    ->live()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', \Str::slug($state))),
                TextInput::make('slug')
                    ->label('slug')
                    ->readOnly(),
                Textarea::make('content')
                    ->label('Deskripsi'),
                TextInput::make('row')
                    ->label('Urutan Upload')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->label('Judul'),
                Tables\Columns\TextColumn::make('content')->label('Deksripsi'),
                TextColumn::make('row')->description('Urutan penataan penampilan didalam Website')->label('Urutan'),
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
            'index' => Pages\ListKategoriPosts::route('/'),
            'create' => Pages\CreateKategoriPost::route('/create'),
            'edit' => Pages\EditKategoriPost::route('/{record}/edit'),
        ];
    }
}
