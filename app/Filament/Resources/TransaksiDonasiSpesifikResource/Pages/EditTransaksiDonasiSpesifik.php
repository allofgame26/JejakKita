<?php

namespace App\Filament\Resources\TransaksiDonasiSpesifikResource\Pages;

use App\Filament\Resources\TransaksiDonasiSpesifikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiDonasiSpesifik extends EditRecord
{
    protected static string $resource = TransaksiDonasiSpesifikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
