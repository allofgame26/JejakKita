<?php

namespace App\Filament\Resources\MandorResource\Pages;

use App\Filament\Resources\MandorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMandor extends EditRecord
{
    protected static string $resource = MandorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->extraAttributes(['data-cy' => 'delete-button']),
        ];
    }
}
