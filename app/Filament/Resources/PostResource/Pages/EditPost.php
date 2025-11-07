<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\View\View;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('preview')
                ->label('Preview')
                ->icon('heroicon-o-eye')
                ->color('gray')
                ->modalContent(fn (): View => view(
                    'filament.preview.post-preview',
                    ['post' => $this->getRecord()]
                ))
                ->modalHeading('Preview Tampilan Post')
                ->modalSubmitAction(false)
                ->modalCancelAction(false)
                ->extraAttributes(['data-cy' => 'preview-button']),

            DeleteAction::make()
        ];
    }
}
