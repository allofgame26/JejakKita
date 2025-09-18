<?php

namespace App\Filament\Resources\TransaksiDonasiProgramResource\Pages;

use App\Filament\Resources\TransaksiDonasiProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaksiDonasiProgram extends CreateRecord
{
    protected static string $resource = TransaksiDonasiProgramResource::class;

    //function untuk jika ada Route yang memiliki parameter didalamnya.
    public function mount(): void
    {
        parent::mount();

        if(request()->has('program_id') && request()->has('user_id') && request()->has('status_pembayaran')){
            $this->form->fill([
                'program_id' =>request()->get('program_id'),
                'user_id' =>request()->get('user_id'),
                'status_pembayaran' => request()->get('status_pembayaran'),
            ]);
        }
    }
}
