<?php

namespace App\Filament\Resources\TransaksiDonasiProgramResource\Pages;

use App\Filament\Resources\TransaksiDonasiProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiDonasiProgram extends EditRecord
{
    protected static string $resource = TransaksiDonasiProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
