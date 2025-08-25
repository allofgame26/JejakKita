<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\m_data_diri;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\ImageColor;
use SebastianBergmann\Type\TrueType;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'Data Akun';

    protected static ?string $navigationGroup = 'Super Admin';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Banyaknya User';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Username'),
                TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: TRUE)
                    ->required(),
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->revealable()
                    ->label('Password')
                    ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null) //melakukan edit sebuah value yang di inputkan, setelah itu dimasukkan kedalam database
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state)), // melakukan hanya simpan jika kolom diisi 
                Select::make('id_identitas')
                    ->label('Data Diri')
                    ->preload()
                    ->relationship('datadiri','nama_lengkap')
                    ->searchable(['nama_lengkap','nip'])
                    ->preload(),
                Select::make('roles')
                    ->relationship('roles','name')
                    ->label('Roles')
                    ->preload()
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_url')->label('Profile'),
                TextColumn::make('name')
                    ->label('username'),
                TextColumn::make('email')
                    ->label('E-Mail'),
                TextColumn::make('datadiri.nip')
                    ->label('NIP'),
                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
