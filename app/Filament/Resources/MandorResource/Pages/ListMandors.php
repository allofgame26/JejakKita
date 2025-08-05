<?php

namespace App\Filament\Resources\MandorResource\Pages;

use App\Filament\Resources\MandorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListMandors extends ListRecords
{
    protected static string $resource = MandorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Daftar Mandor';
    }

    public function getBreadcrumb(): ?string
    {
        return 'Daftar-Mandor';
    }
}
