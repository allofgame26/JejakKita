<?php

namespace App\Filament\Resources\PengisianDonasiResource\Pages;

use App\Filament\Resources\PengisianDonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengisianDonasis extends ListRecords
{
    protected static string $resource = PengisianDonasiResource::class;

    protected ?string $heading = 'Pengisian Donasi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
