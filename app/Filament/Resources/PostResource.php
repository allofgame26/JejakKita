<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\m_post;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = m_post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    
    protected static ?string $navigationLabel = 'Data Post';

    protected static ?string $navigationGroup = 'Management Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', \Str::slug($state))),
                TextInput::make('slug')
                    ->label('slug')
                    ->readOnly(),
                Select::make('kategori')
                    ->relationship('kategori','title')
                    ->required()
                    ->multiple(),
                Hidden::make('user_id')
                    ->default(fn ()=> auth()->id()),
                Toggle::make('is_published')
                    ->label('Di Publish'),
                TextInput::make('meta_description')
                    ->label('Meta Deskripsi')
                    ->required(),
                TextInput::make('content')
                    ->label('Deskripsi')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('media')
                    ->label('Media Foto')
                    ->collection('media')
                    ->image()->imageEditor(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul'),
                ToggleColumn::make('is_published')
                    ->label('Di Publish'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y'),
                SpatieMediaLibraryImageColumn::make('media')
                    ->collection('media')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
