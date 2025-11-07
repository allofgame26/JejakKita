<?php

namespace App\Filament\Resources\PengisianDonasiResource\Pages;

use App\Filament\Resources\PengisianDonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengisianDonasi extends EditRecord
{
    protected static string $resource = PengisianDonasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->extraAttributes(['data-cy' => 'delete-button']),
        ];
    }
}

