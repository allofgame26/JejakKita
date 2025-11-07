<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFeedback extends ManageRecords
{
    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tulis feedback')
                ->icon('heroicon-o-pencil-square')
                ->extraAttributes(['data-cy' => 'create-feedback-button']),
        ];
    }
}
