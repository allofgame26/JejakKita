<?php

namespace App\Filament\Widgets;

use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class DashboardWidget extends ChartWidget
{
    protected static ?string $heading = 'Donasi Harian (30 Hari terakhir)';

    protected static ?int $sort = 1;

    protected function getData(): array
    {

        // ambil data
        $dataProgram = Trend::model(t_transaksi_donasi_program::class)->dateColumn('updated_at')->between(start: now()->subDays(30),end: now())->perDay()->sum('jumlah_donasi');

        $dataSpesifik = Trend::model(t_transaksi_donasi_spesifik::class)->dateColumn('updated_at')->between(start: now()->subDays(30),end: now())->perDay()->sum('jumlah_donasi');

        // Menggabungkan data

        $dataGabungan = [];

        foreach ($dataProgram as $item) {
            $dataGabungan[$item->date] = $item->aggregate;
        }

        foreach ($dataSpesifik as $item) {
            if (isset($dataGabungan[$item->date])){
                $dataGabungan[$item->date] += $item->aggregate;
            } else {
                $dataGabungan[$item->date] = $item->aggregate;
            }
        }

        ksort($dataGabungan);

        return [
            'datasets' => [
                [
                    'label' => 'Donasi Terkumpul',
                    'data' => array_values($dataGabungan), //mengambil nilainya
                    'borderColor' => '#36A2EB',
                    'backgroundColor' => '#9BD0F5',
                ],
            ],
            //mengambil tanggal
            'labels' => array_keys($dataGabungan),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
