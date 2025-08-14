<?php

namespace App\Filament\Resources\ViewKwitansiDigitalResource\Pages;

use App\Filament\Resources\ViewKwitansiDigitalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListViewKwitansiDigitals extends ListRecords
{
    protected static string $resource = ViewKwitansiDigitalResource::class;

    protected function getHeaderActions(): array
    {
            return []; // Hilangkan tombol Create
    }
}
