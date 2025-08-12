<?php

namespace App\Filament\Resources\TransaksiDonasiProgramResource\Pages;

use App\Filament\Resources\TransaksiDonasiProgramResource;
use App\Models\m_metode_pembayaran;
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
                TextInput::make('status_pembayaran')
                    ->readOnly(),
                Select::make('pembayaran_id')
                    ->required()
                    ->disabled()
                    ->options(m_metode_pembayaran::where('is_open', true)->pluck('nama_pembayaran','id'))
                    ->label('Pilih Pembayaran')
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state){
                        $pembayaran = m_metode_pembayaran::find($state);
                        if($pembayaran){
                            $set('nomor_rekening',$pembayaran->no_rekening);
                        }
                    })
                    ->afterStateHydrated(function (callable $set, $state) {
                        if ($state) {
                            $pembayaran = m_metode_pembayaran::find($state);
                            if ($pembayaran) {
                                $set('nomor_rekening', $pembayaran->no_rekening);
                            }
                        }
                    }),
                TextInput::make('nomor_rekening')
                    ->label('Nomor Rekening')
                    ->visible(fn ($get) => filled($get('pembayaran_id')))
                    ->readOnly(),
                SpatieMediaLibraryFileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->collection('bukti_pembayaran')
                    ->reactive()
                    ->required()
                    ->image()->imageEditor()
                    // ->afterStateUpdated( function (callable $set, $state){
                    //     if (!empty($state)) {
                    //         $set('status_pembayaran','sukses');
                    //     }
                    // }),
            ]);
    }

    public function getTitle(): string|Htmlable
    {
        return 'Edit Transaksi Donasi Program';
    }
}
