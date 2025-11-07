<?php

namespace App\Filament\Resources\ProgramPembangunanResource\Pages;

use App\Filament\Resources\ProgramPembangunanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramPembangunan extends EditRecord
{
    protected static string $resource = ProgramPembangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->extraAttributes(['data-cy' => 'delete-button']),
        ];
    }
}
