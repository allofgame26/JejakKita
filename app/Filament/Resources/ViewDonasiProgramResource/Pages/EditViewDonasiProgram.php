<?php

namespace App\Filament\Resources\ViewDonasiProgramResource\Pages;

use App\Filament\Resources\ViewDonasiProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditViewDonasiProgram extends EditRecord
{
    protected static string $resource = ViewDonasiProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
