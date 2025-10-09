<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramPembangunanResource\Pages;
use App\Filament\Resources\ProgramPembangunanResource\RelationManagers\BarangRelationManager;
use App\Filament\Resources\ProgramPembangunanResource\RelationManagers\PriorityRelationManager;
use App\Models\m_program_pembangunan;
use App\Models\m_periode;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                Select::make('tipe_donasi')
                    ->label('Tipe Donasi')
                    ->options([
                        'donasi_berkelanjutan' => 'Donasi Berkelanjutan',
                        'donasi_target' => 'Donasi Target'
                    ])
                    ->required()
                    ->live(),
                Select::make('periode_id')
                    ->label('Periode Pembangunan')
                    ->options(m_periode::all()->pluck('nama_periode','id'))
                    ->required(),
                DatePicker::make('tanggal_mulai')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->required(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_target')
                    ->minDate(fn (string $operation): ?string => $operation === 'create' ? now() : null)
                    ->suffixIcon('heroicon-m-calendar')
                    ->live()
                    ->disabled(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_berkelanjutan'),
                DatePicker::make('estimasi_tanggal_selesai')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->required(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_target')
                    ->minDate(fn ($get) => $get('tanggal_mulai'))
                    ->suffixIcon('heroicon-m-calendar')
                    ->disabled(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_berkelanjutan'),
                DatePicker::make('tanggal_selesai_aktual')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->minDate(fn ($get) => $get('tanggal_mulai'))
                    ->suffixIcon('heroicon-m-calendar')
                    ->disabled(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_berkelanjutan'),
                TextInput::make('estimasi_biaya')
                    ->numeric()
                    ->required(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_target')
                    ->prefix('Rp.')
                    ->disabled(fn (Get $get):bool  => $get('tipe_donasi') === 'donasi_berkelanjutan'),
                Hidden::make('status')
                    ->default('pendanaan'),
                SpatieMediaLibraryFileUpload::make('foto_pembangunan')
                        ->multiple()
                        ->collection('pembangunan'),
                RichEditor::make('deskripsi')
                        ->required(),
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
                TextColumn::make('progress_donasi')
                    ->label('Progress Donasi')
                    ->getStateUsing(function (m_program_pembangunan $record) {
                        $total = $record->estimasi_biaya ?? 0;
                        $progress = $record->hitungTotalDonasiTerkumpul();
                        
                        if ($total == 0) return 'Target belum ditentukan';
                        
                        $percentage = round(($progress / $total) * 100, 1);
                        return "Rp " . number_format($progress) . " / Rp " . number_format($total) . " ({$percentage}%)";
                    })
                    ->wrap(),
                TextColumn::make('skor_prioritas_akhir')
                    ->label('Prioritas')
                    ->icon('heroicon-o-information-circle')
                    ->numeric(2)
                    ->sortable()
                    ->placeholder('Berikan prioritas pada program ini'),
            ])
            ->defaultSort('skor_prioritas_akhir','desc')
            ->filters([
                //
            ])
            ->actions([
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
            TextEntry::make('kode_program')->label('Kode Program'),
            TextEntry::make('nama_pembangunan')->label('Nama Pembangunan'),
            TextEntry::make('tanggal_mulai')->label('Tanggal Mulai'),
            TextEntry::make('status')->label('Status'),
            TextEntry::make('estimasi_biaya')->label('Estimasi Biaya'),
            TextEntry::make('skor_prioritas_akhir')->label('Prioritas'),
            TextEntry::make('deskripsi')->label('Deskripsi'),
            // Tambahkan field lain sesuai kebutuhan
        ];
    }
}