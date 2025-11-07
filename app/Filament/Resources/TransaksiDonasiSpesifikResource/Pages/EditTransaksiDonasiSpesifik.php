<?php

namespace App\Filament\Resources\TransaksiDonasiSpesifikResource\Pages;

use App\Filament\Resources\TransaksiDonasiSpesifikResource;
use App\Models\m_metode_pembayaran;
use Dvarilek\FilamentTableSelect\Components\Form\TableSelect;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EditTransaksiDonasiSpesifik extends EditRecord
{
    protected static string $resource = TransaksiDonasiSpesifikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->extraAttributes(['data-cy' => 'delete-button']),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TableSelect::make('kebutuhan')
                                ->relationship('kebutuhan','id')
                                ->label('Kebutuhan Barang')
                                ->optionColor('success')
                                ->selectionTable(function (Table $table) {
                                    return $table
                                        ->heading('Pilih Barang')
                                        ->columns([
                                            TextColumn::make('barang.nama_barang')->label('Nama Barang'),
                                            TextColumn::make('jumlah_barang')->label('Jumlah Barang'),
                                            TextColumn::make('status')->label('status')->badge(),
                                        ])
                                        ->modifyQueryUsing(function ($query) {
                                            return $query->with('barang')->where('status','tersedia');
                                        });
                                    })
                                ->multiple()
                                ->required()
                                ->getOptionLabelFromRecordUsing(fn ($record) => $record->barang->nama_barang ?? '-')
                                ->disabled()
                                ,
                TextInput::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->readOnly(),
                Select::make('pembayaran_id')
                    ->required()
                    ->options(m_metode_pembayaran::where('is_open', true)->pluck('nama_pembayaran','id'))
                    ->label('Pilih Pembayaran')
                    ->reactive()
                    ->disabled()
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
                TextInput::make('jumlah_donasi')
                    ->label('Jumlah Donasi')
                    ->readOnly(),
                SpatieMediaLibraryFileUpload::make('bukti_pembayaran_spesifik')
                    ->label('Bukti Pembayaran')
                    ->collection('bukti_pembayaran_spesifik')
                    ->required()
                    ->image()->imageEditor()
                
            ]);
    }
}
