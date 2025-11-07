<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->extraAttributes(['data-cy' => 'create-user-button']),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Daftar Akun';
    }

    public function getBreadcrumb(): ?string
    {
        return 'Akun';
    }
}
