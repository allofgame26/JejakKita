<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengisianDonasiResource\Pages;
use App\Models\t_pengisian_donasi;
use App\Models\m_program_pembangunan;
use App\Models\m_metode_pembayaran;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Forms\Get;
use Filament\Forms\Set;

class PengisianDonasiResource extends Resource
{
    protected static ?string $model = t_pengisian_donasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = 'Pengisian Donasi';

    protected static ?string $label = 'Pengisian Donasi';

    protected static ?string $pluralLabel = 'Pengisian Donasi';

    protected static ?string $navigationGroup = 'Donasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Donatur')
                    ->searchable()
                    ->preload(),

                Select::make('donasi_type')
                    ->options([
                        'program' => 'Donasi Program Pembangunan',
                        'spesifik' => 'Donasi Spesifik',
                    ])
                    ->required()
                    ->label('Jenis Donasi')
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('donasi_id', null)),

                Select::make('donasi_id')
                    ->label('Pilih Donasi')
                    ->required()
                    ->options(function (Get $get) {
                        $type = $get('donasi_type');
                        
                        if ($type === 'program') {
                            return m_program_pembangunan::pluck('nama_pembangunan', 'id');
                        } elseif ($type === 'spesifik') {
                            // Asumsi ada model untuk donasi spesifik
                            // return DonasiSpesifik::pluck('nama_donasi', 'id');
                            return []; // Sementara kosong sampai model donasi spesifik dibuat
                        }
                        
                        return [];
                    })
                    ->searchable()
                    ->preload()
                    ->disabled(fn (Get $get) => !filled($get('donasi_type')))
                    ->placeholder(fn (Get $get) => $get('donasi_type') ? 'Pilih donasi...' : 'Pilih jenis donasi terlebih dahulu'),

                Select::make('pembayaran_id')
                    ->relationship('pembayaran', 'nama_pembayaran')
                    ->required()
                    ->label('Metode Pembayaran')
                    ->searchable()
                    ->preload(),

                TextInput::make('jumlah_donasi')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Jumlah Donasi')
                    ->minValue(1000)
                    ->step(1000),

                Textarea::make('pesan_donatur')
                    ->label('Pesan Donatur')
                    ->rows(3)
                    ->columnSpanFull(),

                DateTimePicker::make('tanggal_donasi')
                    ->required()
                    ->default(now()->setTimezone('Asia/Jakarta'))
                    ->timezone('Asia/Jakarta')
                    ->label('Tanggal Donasi')
                    ->displayFormat('d/m/Y H:i')
                    ->format('Y-m-d H:i:s'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Donatur')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('donasi_type')
                    ->label('Jenis Donasi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'program' => 'info',
                        'spesifik' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'program' => 'Program',
                        'spesifik' => 'Spesifik',
                    }),

                TextColumn::make('nama_donasi')
                    ->label('Nama Donasi')
                    ->getStateUsing(function ($record) {
                        return $record->getNamaDonasi();
                    }),

                TextColumn::make('jumlah_donasi')
                    ->label('Jumlah Donasi')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('pembayaran.nama_pembayaran')
                    ->label('Metode Pembayaran')
                    ->sortable(),

                TextColumn::make('tanggal_donasi')
                    ->label('Tanggal Donasi')
                    ->dateTime('d/m/Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('donasi_type')
                    ->label('Jenis Donasi')
                    ->options([
                        'program' => 'Program',
                        'spesifik' => 'Spesifik',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->modal()
                    ->modalHeading('Detail Pengisian Donasi')
                    ->modalWidth('4xl')
                    ->infolist([
                        \Filament\Infolists\Components\Section::make('Informasi Donatur')
                            ->schema([
                                \Filament\Infolists\Components\Grid::make(2)
                                    ->schema([
                                        \Filament\Infolists\Components\TextEntry::make('user.name')
                                            ->label('Username'),
                                        \Filament\Infolists\Components\TextEntry::make('user.datadiri.nama_lengkap')
                                            ->label('Nama Lengkap')
                                            ->placeholder('Tidak tersedia'),
                                        \Filament\Infolists\Components\TextEntry::make('user.email')
                                            ->label('Email'),
                                        \Filament\Infolists\Components\TextEntry::make('tanggal_donasi')
                                            ->label('Tanggal Donasi')
                                            ->dateTime('d/m/Y H:i'),
                                    ]),
                            ]),

                        \Filament\Infolists\Components\Section::make('Detail Donasi')
                            ->schema([
                                \Filament\Infolists\Components\Grid::make(2)
                                    ->schema([
                                        \Filament\Infolists\Components\TextEntry::make('donasi_type')
                                            ->label('Jenis Donasi')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'program' => 'info',
                                                'spesifik' => 'warning',
                                            })
                                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                                'program' => 'Donasi Program Pembangunan',
                                                'spesifik' => 'Donasi Spesifik',
                                            }),
                                        \Filament\Infolists\Components\TextEntry::make('nama_donasi')
                                            ->label('Nama Donasi/Program')
                                            ->getStateUsing(function ($record) {
                                                return $record->getNamaDonasi();
                                            }),
                                    ]),
                                \Filament\Infolists\Components\Grid::make(2)
                                    ->schema([
                                        \Filament\Infolists\Components\TextEntry::make('jumlah_donasi')
                                            ->label('Jumlah Donasi')
                                            ->money('IDR'),
                                        \Filament\Infolists\Components\TextEntry::make('pembayaran.nama_pembayaran')
                                            ->label('Metode Pembayaran'),
                                    ]),
                            ]),

                        \Filament\Infolists\Components\Section::make('Pesan Donatur')
                            ->schema([
                                \Filament\Infolists\Components\TextEntry::make('pesan_donatur')
                                    ->label('Pesan dari Donatur')
                                    ->placeholder('Tidak ada pesan')
                                    ->columnSpanFull()
                                    ->formatStateUsing(fn ($state) => $state ?? 'Donatur tidak meninggalkan pesan'),
                            ])
                            ->collapsible()
                            ->collapsed(false),
                    ]),
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tanggal_donasi', 'desc');
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
            'index' => Pages\ListPengisianDonasis::route('/'),
            'create' => Pages\CreatePengisianDonasi::route('/create'),
            'edit' => Pages\EditPengisianDonasi::route('/{record}/edit'),
        ];
    }
}
