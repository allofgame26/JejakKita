<?php

namespace App\Filament\Resources\HistoryTransaksiResource\Pages;

use App\Filament\Resources\HistoryTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHistoryTransaksis extends ManageRecords
{
    protected static string $resource = HistoryTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
