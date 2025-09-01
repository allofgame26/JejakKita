<?php

namespace App\Filament\Pages;

use App\Models\m_data_diri;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LengkapiDataDiri extends Page implements HasForms
{

    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.lengkapi-data-diri';

    public function hasLogo(): bool
    {
        return false;
    }

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        if (Auth::user()->datadiri_id){
            redirect()->route('filament.admin.pages.dashboard');
        }
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_lengkap'),
                TextInput::make('nim'),
                TextInput::make('tempat_lahir'),
                DatePicker::make('tanggal_lahir'),
                TextInput::make('alamat'),
                Select::make('jenis_kelamin')
                    ->options([
                        'laki' => 'Laki - Laki',
                        'perempuan' => 'Perempuan'
                ]),
                TextInput::make('no_telp')
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan dan Lanjutkan')
                ->submit('save')
        ];
    }

        public function save(): void
        {
            $data = $this->form->getState();
            // Ambil instance model User yang sebenarnya dari database
            $user = \App\Models\User::find(Auth::id());

            // Gunakan transaksi untuk memastikan kedua operasi berhasil
            DB::transaction(function () use ($data, $user) {
                // 1. Buat record data diri baru
                $dataDiri = m_data_diri::create($data);

                // 2. Hubungkan data diri baru ke user yang sedang login
                $user->datadiri_id = $dataDiri->id;
                $user->save();
            });
            
            Notification::make()
                ->title('Profil berhasil dilengkapi!')
                ->success()
                ->send();
                
            // Arahkan ke dashboard setelah berhasil
            redirect()->route('filament.admin.pages.dashboard');
        }
}
