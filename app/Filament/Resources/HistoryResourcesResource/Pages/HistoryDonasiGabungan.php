<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\t_transaksi_donasi_program;

class HistoryDonasiGabungan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static string $view = 'filament.pages.history-donasi-gabungan';
    protected static ?string $navigationLabel = 'History Donasi Gabungan';
    protected static ?string $navigationGroup = 'Transaksi';

    public $history = [];

    public function mount()
    {
        $this->history = t_transaksi_donasi_program::getCombinedHistory();
    }

    protected function getViewData(): array
    {
        return [
            'history' => $this->history,
        ];
    }
}