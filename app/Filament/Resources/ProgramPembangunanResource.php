<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramPembangunanResource\Pages;
use App\Filament\Resources\ProgramPembangunanResource\RelationManagers\BarangRelationManager;
use App\Filament\Resources\ProgramPembangunanResource\RelationManagers\PriorityRelationManager;
use App\Models\m_periode;
use App\Models\m_program_pembangunan;
use App\Models\Priority;
use App\Models\Priority_Pembangunan;
use App\Models\t_kebutuhan_barang_program;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Dotenv\Util\Str;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
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

    protected static ?int $navigationSort = 14;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('mandor_id')
                    ->required()
                    ->relationship('mandor','nama_lengkap')
                    ->searchable()
                    ->extraAttributes(['data-cy' => 'mandor-id']), //memliki kekurangan kita harus mengetahui Mandornya siapa saja
                TextInput::make('nama_pembangunan')
                    ->required()
                    ->label('Nama Pembangunan')
                    ->extraAttributes(['data-cy' => 'nama-pembangunan']),
                Select::make('tipe_donasi')
                    ->label('Tipe Donasi')
                    ->options([
                        'donasi_berkelanjutan' => 'Donasi Berkelanjutan',
                        'donasi_target' => 'Donasi Target'
                    ])
                    ->required()
                    ->live()
                    ->extraAttributes(['data-cy' => 'tipe-donasi']),
                Select::make('periode_id')
                    ->label('Periode Pembangunan')
                    ->relationship('periode','nama_periode')
                    ->required()
                    ->extraAttributes(['data-cy' => 'periode-pembangunan']),
                DatePicker::make('tanggal_mulai')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->required(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_target')
                    ->minDate(fn (string $operation): ?string => $operation === 'create' ? now() : null)
                    ->suffixIcon('heroicon-m-calendar')
                    ->live()
                    ->disabled(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_berkelanjutan')
                    ->extraAttributes(['data-cy' => 'tanggal-mulai']),
                DatePicker::make('estimasi_tanggal_selesai')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->required(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_target')
                    ->minDate(fn ($get) => $get('tanggal_mulai'))
                    ->suffixIcon('heroicon-m-calendar')
                    ->disabled(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_berkelanjutan')
                    ->extraAttributes(['data-cy' => 'estimasi-tanggal-selesai']),
                TextInput::make('estimasi_biaya')
                    ->numeric()
                    ->required(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_target')
                    ->prefix('Rp.')
                    ->disabled(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_berkelanjutan')
                    ->extraAttributes(['data-cy' => 'estimasi-biaya']),
                Hidden::make('status')
                    ->default('pendanaan'),
                SpatieMediaLibraryFileUpload::make('foto_pembangunan')
                        ->multiple()
                        ->collection('pembangunan')
                        ->conversion('compressed')
                        ->maxSize(2048)
                        ->helperText('Ukuran maksimum file adalah 2MB.')
                        ->extraAttributes(['data-cy' => 'foto-pembangunan']),
                Textarea::make('deskripsi')
                        ->required()
                        ->label('Deskripsi Program')
                        ->extraAttributes(['data-cy' => 'deskripsi-pembangunan']),
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
                    ->date('d M Y')
                    ->placeholder('Tidak ada tanggal mulai'),
                TextColumn::make('tipe_donasi')
                    ->label('Tipe Donasi')
                    ->badge()
                    ->visible(fn ($record): bool => auth()->user()->hasRole(['admin','super_admin']))
                    ->color(fn (string $state): string => match ($state) {
                        'donasi_berkelanjutan' => 'primary',
                        'donasi_target' => 'success',
                    }),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendanaan' => 'warning',
                        'berjalan' => 'info',
                        'selesai' => 'success',
                        'ditunda' => 'danger',
                    }),
                ProgressBar::make('progress_program')
                    ->label('Progress Donasi')
                    ->getStateUsing(function (m_program_pembangunan $record){
                        $total = $record->estimasi_biaya;

                        $progress = $record->hitungTotalDonasiTerkumpul();
                        
                        return [
                            'total' => $total,
                            'progress' => $progress,
                        ];
                    }),
                TextColumn::make('hitungTotalDonasiTerkumpul')
                    ->label('Total Donasi Terkumpul')
                    ->money('IDR')
                    ->size(TextColumnSize::Small)
                    ->sortable()
                    ->getStateUsing(function (m_program_pembangunan $record){
                        return $record->hitungTotalDonasiTerkumpul();
                    }),
                TextColumn::make('skor_prioritas_akhir')
                    ->label('Prioritas')
                    ->icon('heroicon-o-information-circle')
                    ->numeric(2)
                    ->sortable()
                    ->placeholder('Belum ada poin prioritas'),
            ])
            ->defaultSort('skor_prioritas_akhir','desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->extraAttributes(['data-cy' => 'view-program']),
                Tables\Actions\EditAction::make()->extraAttributes(['data-cy' => 'edit-program']),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        // Sekarang kita panggil fungsi yang mengembalikan array, dan memasukkannya ke dalam schema()
        return $infolist->schema(static::getInfolistSchema());
    }

    public static function getInfolistSchema(): array
    {
        return [
            Section::make('Informasi Utama')
                ->columns(2)
                ->schema([
                    TextEntry::make('nama_pembangunan')
                        ->label('Nama Program'),
                    TextEntry::make('status')
                        ->badge(),
                    TextEntry::make('estimasi_biaya')
                        ->label('Target Dana')
                        ->money('IDR'),
                    TextEntry::make('periode.nama_periode')
                        ->label('Periode'),
                ]),

            Section::make('Detail Program')
                ->schema([
                    TextEntry::make('deskripsi')
                        ->label('Deskripsi Program')
                        ->columnSpanFull(),
                    SpatieMediaLibraryImageEntry::make('foto_pembangunan')
                        ->label('Gambar Utama')
                        ->collection('pembangunan')
                        ->columnSpanFull(),
                ])
        ];
    }
}
