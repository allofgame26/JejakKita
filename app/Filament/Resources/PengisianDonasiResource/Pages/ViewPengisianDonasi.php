<?php

namespace App\Filament\Resources\PengisianDonasiResource\Pages;

use App\Filament\Resources\PengisianDonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;

class ViewPengisianDonasi extends ViewRecord
{
    protected static string $resource = PengisianDonasiResource::class;

    protected ?string $heading = 'Detail Pengisian Donasi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Donatur')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Username'),
                                TextEntry::make('user.datadiri.nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->placeholder('Tidak tersedia'),
                                TextEntry::make('user.email')
                                    ->label('Email'),
                                TextEntry::make('tanggal_donasi')
                                    ->label('Tanggal Donasi')
                                    ->dateTime('d/m/Y H:i'),
                            ]),
                    ]),

                Section::make('Detail Donasi')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('donasi_type')
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
                                TextEntry::make('nama_donasi')
                                    ->label('Nama Donasi/Program')
                                    ->getStateUsing(function ($record) {
                                        return $record->getNamaDonasi();
                                    }),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('jumlah_donasi')
                                    ->label('Jumlah Donasi')
                                    ->money('IDR'),
                                TextEntry::make('pembayaran.nama_pembayaran')
                                    ->label('Metode Pembayaran'),
                            ]),
                    ]),

                Section::make('Pesan Donatur')
                    ->schema([
                        TextEntry::make('pesan_donatur')
                            ->label('Pesan dari Donatur')
                            ->placeholder('Tidak ada pesan')
                            ->columnSpanFull()
                            ->formatStateUsing(fn ($state) => $state ?? 'Donatur tidak meninggalkan pesan'),
                    ])
                    ->collapsible(),
            ]);
    }
}
