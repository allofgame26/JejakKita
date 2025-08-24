<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramPembangunanResource\Pages;
use App\Filament\Resources\ProgramPembangunanResource\RelationManagers\BarangRelationManager;
use App\Filament\Resources\ProgramPembangunanResource\RelationManagers\PriorityRelationManager;
use App\Models\m_program_pembangunan;
use App\Models\Priority;
use App\Models\Priority_Pembangunan;
use App\Models\t_kebutuhan_barang_program;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
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
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Enums\RecordCheckboxPosition;
use Filament\Tables\Table;
use IbrahimBougaoua\FilaProgress\Tables\Columns\ProgressBar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class ProgramPembangunanResource extends Resource
{
    protected static ?string $model = m_program_pembangunan::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Data Pembangunan';

    protected static ?string $pluralLabel = 'Data Pembangunan';

    protected static ?string $label = 'Data Pembangunan';

    protected static ?string $navigationGroup = 'Pembangunan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_program')
                    ->required()
                    ->unique(ignoreRecord: TRUE)
                    ->validationMessages([
                        'unique' => 'Kode Program sudah Terpakai'
                    ]),
                Select::make('mandor_id')
                    ->required()
                    ->relationship('mandor','nama_lengkap')
                    ->searchable()
                    ->preload(),
                TextInput::make('nama_pembangunan')
                    ->required(),
                DatePicker::make('tanggal_mulai')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->required()
                    ->minDate(now())
                    ->suffixIcon('heroicon-m-calendar')
                    ->live(),
                DatePicker::make('estimasi_tanggal_selesai')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->required()
                    ->minDate(fn ($get) => $get('tanggal_mulai'))
                    ->suffixIcon('heroicon-m-calendar'),
                DatePicker::make('tanggal_selesai_aktual')
                    ->displayFormat('d M Y')
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
                        'direncanakan' => 'Direncanakan',
                        'berjalan' => 'Berjalan',
                        'selesai' => 'Selesai',
                        'ditunda' => 'Ditunda',
                    ])
                    ->required(),
                SpatieMediaLibraryFileUpload::make('foto_pembangunan')
                        ->multiple()
                        ->collection('pembangunan'),
                TextInput::make('deskripsi')
                        ->required()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_program')
                    ->label('Kode Program')
                    ->searchable(),
                TextColumn::make('nama_pembangunan')
                    ->label('Nama Pembangunan'),
                TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->date('d M Y'),
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
                ProgressBar::make('progress_program')
                    ->label('Dana Donasi')
                    ->getStateUsing(function ($record){
                        $t_transaksi_program = t_transaksi_donasi_program::where([['program_id', $record->id],['status_pembayaran', 'sukses']])->sum('jumlah_donasi');
                        $t_transaksi_kebutuhan = t_transaksi_donasi_spesifik::join('donasi_kebutuhans', 't_transaksi_donasi_spesifiks.id','=','donasi_kebutuhans.donasi_id')->join('t_kebutuhan_barang_programs', 'donasi_kebutuhans.kebutuhan_id', '=', 't_kebutuhan_barang_programs.id')->where([['t_kebutuhan_barang_programs.program_id', $record->id],['status_pembayaran','sukses']])->sum('jumlah_donasi');
                        $total = $record->estimasi_biaya;
                        $progress = $t_transaksi_program + $t_transaksi_kebutuhan;
                        return [
                            'total' => $total,
                            'progress' => $progress,
                        ];
                    }),
                TextColumn::make('skor_prioritas_akhir')
                    ->label('Prioritas')
                    ->icon('heroicon-o-information-circle')
                    ->numeric(2)
                    ->sortable()
            ])
            ->defaultSort('skor_prioritas_akhir','desc')
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
            BarangRelationManager::class,
            PriorityRelationManager::class
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
