<?php

namespace App\Filament\Resources\TransaksiDonasiSpesifikResource\Pages;

use App\Filament\Resources\TransaksiDonasiSpesifikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;

class ListTransaksiDonasiSpesifiks extends ListRecords
{
    protected static string $resource = TransaksiDonasiSpesifikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Program')
            ->icon('heroicon-o-plus-circle')
            ->extraAttributes(['data-cy' => 'create-donasi-spesifik-button']),
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

    public function getTabs(): array
    {
        return [
            'Semua' => Tab::make('Semua'),
            'gagal' => Tab::make('Gagal')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pembayaran', 'gagal'))
                ->icon('heroicon-o-exclamation-triangle'),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pembayaran', 'pending'))
                ->icon('heroicon-o-clock'),
            'sukses' => Tab::make('Sukses')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pembayaran', 'sukses'))
                ->icon('heroicon-o-check-badge')
        ];
    }
}
