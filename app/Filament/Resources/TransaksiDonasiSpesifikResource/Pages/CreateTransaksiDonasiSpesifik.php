<?php

namespace App\Filament\Resources\TransaksiDonasiSpesifikResource\Pages;

use App\Filament\Resources\TransaksiDonasiSpesifikResource;
use App\Models\t_kebutuhan_barang_program;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaksiDonasiSpesifik extends CreateRecord
{
    protected static string $resource = TransaksiDonasiSpesifikResource::class;

    protected function afterCreate(): void
    {
        $kebutuhanIds = $this->record->kebutuhan()->allRelatedIds();

        if ($kebutuhanIds->isNotEmpty()) {
            t_kebutuhan_barang_program::whereIn('id', $kebutuhanIds)
                ->update(['status' => 'diambil']);
        }
    }
}


