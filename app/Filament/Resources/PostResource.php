<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\m_post;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
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
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = m_post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    
    protected static ?string $navigationLabel = 'Data Postingan';

    protected static ?string $navigationGroup = 'Management Konten';

    protected static ?string $label = 'Data Postingan';

    protected static ?string $slug = 'posts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->reactive()
                    ->unique(ignoreRecord: TRUE)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('slug')
                    ->readOnly(),
                Select::make('kategori')
                    ->relationship('kategori', 'title')
                    ->preload()
                    ->required(),
                Hidden::make('user_id')
                    ->default(fn() => auth()->id()),
                Toggle::make('is_published')
                    ->label('Di Publish'),
                TextInput::make('meta_description')
                    ->label('Keyword Deskripsi')
                    ->required(),
                MarkdownEditor::make('content')
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
                TextColumn::make('title')->label('Judul'),
                ToggleColumn::make('is_published')->label('Di Publish'),
                TextColumn::make('created_at')->label('Dibuat')->date('d M Y'),
                SpatieMediaLibraryImageColumn::make('media')->collection('media'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Detail Postingan')
                    ->modalContent(fn ($record) => view('filament.resources.post-detail', [
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
