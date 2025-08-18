<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MandorResource\Pages;
use App\Filament\Resources\MandorResource\RelationManagers;
use App\Models\m_mandor;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MandorResource extends Resource
{
    protected static ?string $model = m_mandor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Mandor';

    protected static ?string $navigationGroup = 'Pembangunan';

    protected static ?string $pluralLabel = 'Data Mandor';

    protected static ?string $label = 'Data Mandor';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_lengkap')
                    ->required(),
                TextInput::make('nik')
                    ->unique()
                    ->required()
                    ->label('Nomor Induk Kependudukan')
                    ->minLength(16)
                    ->validationMessages([
                        'unique' => 'NIK sudah Terpakai'
                    ]),
                TextInput::make('tempat_lahir')
                    ->required(),
                DatePicker::make('tanggal_lahir')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->maxDate(now())
                    ->required()
                    ->suffixIcon('heroicon-m-calendar'),
                TextInput::make('alamat')
                    ->required(),
                Select::make('jenis_kelamin')
                    ->options([
                        'laki' => 'Laki - Laki',
                        'perempuan' => 'Perempuan'
                    ])
                    ->required(),
                TextInput::make('no_telp')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('mandor')
                    ->collection('mandor')
                    ->label('Foto Mandor')
                    ->image()
                    ->imageEditor(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('profile')
                    ->label('Profile')
                    ->collection('mandor'),
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
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
            'index' => Pages\ListMandors::route('/'),
            'create' => Pages\CreateMandor::route('/create'),
            'edit' => Pages\EditMandor::route('/{record}/edit'),
        ];
    }
}
