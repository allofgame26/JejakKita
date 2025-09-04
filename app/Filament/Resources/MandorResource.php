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
                Forms\Components\Section::make('Data Mandor')
                    ->description('Isi data mandor dengan lengkap dan benar.')
                    ->schema([
                        TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->required()
                            ->placeholder('Masukkan nama lengkap mandor')
                            ->helperText('Nama sesuai KTP.'),
                        TextInput::make('nik')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->label('Nomor Induk Kependudukan')
                            ->minLength(16)
                            ->placeholder('Masukkan NIK')
                            ->helperText('NIK harus 16 digit.')
                            ->validationMessages([
                                'unique' => 'NIK sudah Terpakai'
                            ]),
                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required()
                            ->placeholder('Masukkan tempat lahir'),
                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->displayFormat('d/m/Y')
                            ->native(false)
                            ->maxDate(now())
                            ->required()
                            ->suffixIcon('heroicon-m-calendar'),
                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->required()
                            ->placeholder('Masukkan alamat lengkap'),
                        Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'laki' => 'Laki - Laki',
                                'perempuan' => 'Perempuan'
                            ])
                            ->required()
                            ->placeholder('Pilih jenis kelamin'),
                        TextInput::make('no_telp')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->required()
                            ->placeholder('Masukkan nomor telepon aktif'),
                        SpatieMediaLibraryFileUpload::make('mandor')
                            ->collection('mandor')
                            ->label('Foto Mandor')
                            ->image()
                            ->imageEditor()
                            ->helperText('Upload foto mandor (jpg/png).'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('profile')
                    ->label('Profile')
                    ->collection('mandor')
                    ->extraImgAttributes(['class' => 'ring-2 ring-blue-400']),
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                TextColumn::make('nik')
                    ->label('NIK')
                    ->copyable()
                    ->color('info'),
                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->color(fn($record) => $record->jenis_kelamin === 'laki' ? 'success' : 'warning'),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Detail Mandor')
                    ->modalContent(fn($record) => view('filament.resources.mandor-detail', [
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
            'index' => Pages\ListMandors::route('/'),
            'create' => Pages\CreateMandor::route('/create'),
            'edit' => Pages\EditMandor::route('/{record}/edit'),
        ];
    }
}
