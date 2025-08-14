<?php

namespace App\Filament\Widgets;

use App\Models\m_program_pembangunan;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class TestWidget extends BaseWidget
{
    protected function getStats(): array
    {

        // Setting Tanggal awal
        $awalBulan = Carbon::now()->startOfMonth()->startOfYear();
        $akhirBulan = Carbon::now()->endOfMonth()->endOfYear();

        $totalProgram = t_transaksi_donasi_program::where('status_pembayaran','sukses')->whereBetween('created_at',[$awalBulan,$akhirBulan])->sum('jumlah_donasi');
        $totalSpesifik = t_transaksi_donasi_spesifik::where('status_pembayaran','sukses')->whereBetween('created_at',[$awalBulan,$akhirBulan])->sum('jumlah_donasi');

        $pendingSpesifikasi = t_transaksi_donasi_spesifik::where('status_pembayaran','pending')->whereBetween('created_at',[$awalBulan,$akhirBulan])->count();
        $pendingProgram = t_transaksi_donasi_program::where('status_pembayaran','pending')->whereBetween('created_at',[$awalBulan,$akhirBulan])->count();

        $total = $totalProgram + $totalSpesifik;
        $totalPending = $pendingProgram + $pendingSpesifikasi;

        return [
            Stat::make('jumlah_pembangunan',m_program_pembangunan::whereBetween('created_at',[$awalBulan,$akhirBulan])->count())
                ->label('Jumlah Pembangunan')
                ->description('Jumlah Pembangunan saat ini')
                ->descriptionIcon('heroicon-o-building-office',IconPosition::Before)
                ->color('success'),
            Stat::make('dana_terkumpul',Number::currency($total,'IDR'))
                ->label('Dana Terkumpul')
                ->color('success')
                ->description('Dana Gabungan yang sudah terkumpul')
                ->descriptionIcon('heroicon-o-credit-card',IconPosition::Before),
            Stat::make('jumlah_pending', $totalPending)
                ->label('Transaksi Pending')
                ->color('warning')
                ->description('Transaksi yang Terpending selama Ini')
                ->descriptionIcon('heroicon-o-exclamation-triangle',IconPosition::Before)
            
        ];
    }
}
