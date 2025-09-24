<?php

namespace App\Filament\Resources\PrioritasResource\Pages;

use App\Filament\Resources\PrioritasResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePrioritas extends ManageRecords
{
    protected static string $resource = PrioritasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
