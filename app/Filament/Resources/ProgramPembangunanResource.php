<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramPembangunanResource\Pages;
use App\Filament\Resources\ProgramPembangunanResource\RelationManagers;
use App\Models\m_program_pembangunan;
use Dotenv\Util\Str;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramPembangunanResource extends Resource
{
    protected static ?string $model = m_program_pembangunan::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Data Pembangunan';

    protected static ?string $navigationGroup = 'Pembangunan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_program')
                    ->required()
                    ->unique()
                    ->validationMessages([
                        'unique' => 'Kode Program sudah Terpakai'
                    ]),
                Select::make('mandor_id')
                    ->required()
                    ->relationship('mandor','nama_lengkap')
                    ->searchable(),
                TextInput::make('nama_pembangunan')
                    ->required(),
                DatePicker::make('tanggal_mulai')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->required()
                    ->minDate(now())
                    ->suffixIcon('heroicon-m-calendar')
                    ->live(),
                DatePicker::make('estimasi_tanggal_selesai')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->required()
                    ->minDate(fn ($get) => $get('tanggal_mulai'))
                    ->suffixIcon('heroicon-m-calendar'),
                DatePicker::make('tanggal_selesai_aktual')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->minDate(fn ($get) => $get('tanggal_mulai'))
                    ->suffixIcon('heroicon-m-calendar'),
                TextInput::make('estimasi_biaya')
                    ->numeric()
                    ->required()
                    ->prefix('Rp. '),
                Select::make('status')
                    ->options([
                        'diajukan' => 'Diajukan',
                        'direncanakan' => 'DiRencanakan',
                        'berjalan' => 'Berjalan',
                        'selesai' => 'Selesai',
                        'ditunda' => 'Ditunda',
                    ])
                    ->required(),
                SpatieMediaLibraryFileUpload::make('foto_pembangunan')
                        ->multiple(),
                TextInput::make('deskripsi')
                        ->required()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_program')
                    ->label('Kode Program'),
                TextColumn::make('nama_pembangunan')
                    ->label('Nama Pembangunan'),
                TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diajukan' => 'primary',
                        'direncanakan' => 'warning',
                        'berjalan' => 'info',
                        'selesai' => 'success',
                        'ditunda' => 'danger',
                    }),
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
            'index' => Pages\ListProgramPembangunans::route('/'),
            'create' => Pages\CreateProgramPembangunan::route('/create'),
            'edit' => Pages\EditProgramPembangunan::route('/{record}/edit'),
        ];
    }
}
