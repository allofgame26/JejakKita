<?php

namespace App\Filament\Resources\TransaksiDonasiSpesifikResource\Pages;

use App\Filament\Resources\TransaksiDonasiSpesifikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListTransaksiDonasiSpesifiks extends ListRecords
{
    protected static string $resource = TransaksiDonasiSpesifikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Program')
            ->icon('heroicon-o-plus-circle'),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Transaksi Donasi Spesifik';
    }

    public function getBreadcrumb(): ?string
    {
        return 'Transaksi Donasi Spesifik';
    }
}
