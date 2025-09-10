<?php
namespace App\Livewire;

use App\Filament\Forms\Schemas\DataDiriSchema;
use App\Models\m_data_diri;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GlobalActions extends Component implements HasForms, HasActions
{

    use InteractsWithActions, InteractsWithForms;

    public function lengkapiDataDiriAction(): Action
    {
        return Action::make('lengkapiDataDiri')
            ->label('Lengkapi Data Diri')
            ->icon('heroicon-o-user-circle')
            ->form(DataDiriSchema::getSchema())
            ->action(function (array $data) {
                $user = \App\Models\User::find(Auth::id());

                if ($user) {
                    $dataDiri = m_data_diri::create($data);
                    $user->datadiri_id = $dataDiri->id;
                    $user->save();

                    Notification::make()
                        ->title('Data diri berhasil disimpan')
                        ->success()
                        ->send();

                    return redirect(request()->header('Referer'));
                }
            })
            ->visible(fn (): bool => ! Auth::user()->datadiri_id);
    }

    public function render()
    {
        return view('livewire.global-actions');
    }
}
