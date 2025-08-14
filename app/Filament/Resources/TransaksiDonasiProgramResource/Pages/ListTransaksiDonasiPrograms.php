<?php

namespace App\Filament\Resources\TransaksiDonasiProgramResource\Pages;

use App\Filament\Resources\TransaksiDonasiProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
// use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;

class ListTransaksiDonasiPrograms extends ListRecords
{
    protected static string $resource = TransaksiDonasiProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Program Manual')
            ->icon('heroicon-o-plus-circle'),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Daftar Donasi Program';
    }

    public function getBreadcrumb(): ?string
    {
        return 'Daftar-Donasi-Program';
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
