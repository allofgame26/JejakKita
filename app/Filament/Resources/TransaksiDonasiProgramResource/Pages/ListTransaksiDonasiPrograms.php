<?php

namespace App\Filament\Resources\TransaksiDonasiProgramResource\Pages;

use App\Filament\Resources\TransaksiDonasiProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
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
}
