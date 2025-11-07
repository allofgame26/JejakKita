<?php

namespace App\Filament\Resources\ProgramPembangunanResource\Pages;

use App\Filament\Resources\ProgramPembangunanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListProgramPembangunans extends ListRecords
{
    protected static string $resource = ProgramPembangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Program')
                ->icon('heroicon-o-plus-circle')->extraAttributes(['data-cy' => 'create-program-button']),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Program Pembangunan';
    }

    public function getBreadcrumb(): ?string
    {
        return 'Program Pembangunan';
    }
}
