<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DashboardWidget extends ChartWidget
{
    protected static ?string $heading = 'Donasi Harian (30 Hari terakhir';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
