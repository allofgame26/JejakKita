<?php

namespace App\Filament\Resources\PengisianDonasiResource\Pages;

use App\Filament\Resources\PengisianDonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePengisianDonasi extends CreateRecord
{
    protected static string $resource = PengisianDonasiResource::class;

    protected ?string $heading = 'Buat Pengisian Donasi';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
