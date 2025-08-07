<?php

namespace App\Filament\Resources\TransaksiDonasiProgramResource\Pages;

use App\Filament\Resources\TransaksiDonasiProgramResource;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTransaksiDonasiProgram extends EditRecord
{
    protected static string $resource = TransaksiDonasiProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('program_id')
                    ->disabled()
                    ->relationship('program', 'nama_pembangunan')
                    ->label('Pilih Program')
                    ->required(),
                TextInput::make('jumlah_donasi')
                    ->required()
                    ->readOnly()
                    ->prefix('Rp.')
                    ->label('Jumlah Donasi'),
                TextInput::make('pesan_donatur')
                    ->readOnly()
                    ->label('Pesan Donatur'),
                Select::make('status_pembayaran')
                    ->options([
                        'gagal' => 'Gagal',
                        'pending' => 'Pending',
                        'sukses' => 'Sukses',
                    ]),
                SpatieMediaLibraryFileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->collection('bukti_pembayaran')
                    ->required()
                    ->image()->imageEditor(),
            ]);
    }

    public function getTitle(): string|Htmlable
    {
        return 'Edit Transaksi Donasi Program';
    }
}
