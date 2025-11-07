<?php

namespace App\Filament\Resources\KategoriPostResource\Pages;

use App\Filament\Resources\KategoriPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriPosts extends ListRecords
{
    protected static string $resource = KategoriPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->extraAttributes(['data-cy' => 'create-kategori-post-button']),
        ];
    }
}
