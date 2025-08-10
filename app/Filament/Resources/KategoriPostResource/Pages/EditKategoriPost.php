<?php

namespace App\Filament\Resources\KategoriPostResource\Pages;

use App\Filament\Resources\KategoriPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriPost extends EditRecord
{
    protected static string $resource = KategoriPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
