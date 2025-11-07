<?php

namespace App\Filament\Resources\MetodePembayaranResource\Pages;

use App\Filament\Resources\MetodePembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListMetodePembayarans extends ListRecords
{
    protected static string $resource = MetodePembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Metode')
                ->icon('heroicon-o-plus-circle')
                ->extraAttributes(['data-cy' => 'create-metode-pembayaran-button']),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Metode Pembayaran';    
    }

    public function getBreadcrumb(): ?string
    {
        return 'Metode-Pembayaran';
    }
}
