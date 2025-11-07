<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataDiriResource\Pages;
use App\Filament\Resources\DataDiriResource\RelationManagers;
use App\Models\m_data_diri;
use Dom\Text;
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
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class DataDiriResource extends Resource
{
    protected static ?string $model = m_data_diri::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Data Diri';

    protected static ?string $navigationGroup = 'Super Admin';

    protected static ?string $pluralLabel = 'Data Diri';

    protected static ?string $label = 'Data Diri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_lengkap')
                    ->required()
                    ->label('Nama Lengkap')
                    ->extraAttributes(['data-cy' => 'nama-lengkap']),
                TextInput::make('nip')
                    ->required()
                    ->unique(ignoreRecord: TRUE)
                    ->label('NIP')
                    ->extraAttributes(['data-cy' => 'nip']),
                TextInput::make('tempat_lahir')
                    ->required()
                    ->label('Tempat Lahir')
                    ->extraAttributes(['data-cy' => 'tempat-lahir']),
                DatePicker::make('tanggal_lahir')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->maxDate(now())
                    ->required()
                    ->label('Tanggal Lahir')
                    ->extraAttributes(['data-cy' => 'tanggal-lahir']),
                TextInput::make('alamat')
                    ->required()
                    ->label('Alamat')
                    ->extraAttributes(['data-cy' => 'alamat']),
                Select::make('jenis_kelamin')
                    ->options([
                        'laki' => 'Laki - Laki',
                        'perempuan' => 'Perempuan'
                    ])
                    ->required()
                    ->label('Jenis Kelamin')
                    ->extraAttributes(['data-cy' => 'jenis-kelamin']),
                TextInput::make('no_telp')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->required()
                    ->label('No. Telp')
                    ->extraAttributes(['data-cy' => 'no-telp']),
                SpatieMediaLibraryFileUpload::make('profile')
                    ->image()
                    ->collection('profile')
                    ->imageEditor()
                    ->conversion('conversion')->maxSize(2048)
                    ->helperText('Ukuran maksimum file adalah 2MB.')
                    ->label('Foto Profil')
                    ->extraAttributes(['data-cy' => 'foto-profil']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('index')
                //     ->state( static function (HasTable $livewire, stdClass $rowLoop): string { return (string) ( $rowLoop->iteration + ($livewire->getTableRecordsPerPage() * ( $livewire->getTablePage() - 1 )) ); } ),
                SpatieMediaLibraryImageColumn::make('profile')
                    ->label('Foto Profil')
                    ->collection('profile'),
                TextColumn::make('nip'),
                TextColumn::make('nama_lengkap'),
                TextColumn::make('no_telp'),
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\EditAction::make()->extraAttributes(['data-cy' => 'edit-data-diri']),
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
            'index' => Pages\ListDataDiris::route('/'),
            'create' => Pages\CreateDataDiri::route('/create'),
            'edit' => Pages\EditDataDiri::route('/{record}/edit'),
        ];
    }
}
