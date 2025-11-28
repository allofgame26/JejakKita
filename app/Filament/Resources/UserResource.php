<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'Data Akun';

    protected static ?string $navigationGroup = 'Super Admin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Username')
                    ->unique(ignoreRecord: TRUE)
                    ->extraAttributes(['data-cy' => 'username']),
                TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: TRUE)
                    ->required()
                    ->extraAttributes(['data-cy' => 'email']),
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->revealable()
                    ->label('Password')
                    ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null) //melakukan edit sebuah value yang di inputkan, setelah itu dimasukkan kedalam database
                    ->required(fn (string $context): bool => $context === 'create')
                    ->extraAttributes(['data-cy' => 'password'])
                    ->dehydrated(fn ($state) => filled($state)), // melakukan hanya simpan jika kolom diisi 
                Select::make('roles')
                    ->relationship('roles','name')
                    ->label('Roles')
                    ->preload()
                    ->searchable()
                    ->extraAttributes(['data-cy' => 'roles']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('profile_url')->label('Profile')->collection('profile'),
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
                Tables\Actions\EditAction::make()->extraAttributes(['data-cy' => 'edit-user']),
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
