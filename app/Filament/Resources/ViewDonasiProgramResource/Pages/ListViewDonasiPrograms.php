<?php

namespace App\Filament\Resources\ViewDonasiProgramResource\Pages;

use App\Filament\Resources\ViewDonasiProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListViewDonasiPrograms extends ListRecords
{
    protected static string $resource = ViewDonasiProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
