<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\m_vendor;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VendorResource extends Resource
{
    protected static ?string $model = m_vendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Data Vendor';

    protected static ?string $navigationGroup = 'Pembangunan';

    protected static ?string $pluralLabel = 'Data Vendor';

    protected static ?string $label = 'Data Vendor'; 

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('kode_vendor'),
                TextInput::make('nama_vendor')
                    ->label('Nama Vendor')
                    ->required()
                    ->extraAttributes(['data-cy' => 'nama-vendor']),
                TextInput::make('alamat_vendor')
                    ->label('Alamat Vendor')
                    ->required()
                    ->extraAttributes(['data-cy' => 'alamat-vendor']),
                TextInput::make('no_telepon')
                    ->label('Nomor Telepon / WhatsApp')
                    ->required()
                    ->extraAttributes(['data-cy' => 'no-telepon']),
                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->extraAttributes(['data-cy' => 'keterangan']),
                Hidden::make('status')
                    ->default('aktif')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_vendor')
                    ->label('Nama Vendor'),
                TextColumn::make('alamat_vendor')
                    ->label('Alamat Vendor'),
                TextColumn::make('no_telepon')
                    ->label('Nomor Telepon')
                    ->copyable(),
                TextColumn::make('status')
                    ->label('Status')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->extraAttributes(['data-cy' => 'edit-vendor']),
                Tables\Actions\DeleteAction::make()->extraAttributes(['data-cy' => 'delete-vendor']),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVendors::route('/'),
        ];
    }
}
