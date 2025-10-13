<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProgramPembangunanResource;
use App\Models\m_program_pembangunan;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use IbrahimBougaoua\FilaProgress\Tables\Columns\ProgressBar;

class ProgramPembangunanWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                m_program_pembangunan::query()->where('status_pendanaan','belum_lengkap')->limit(5)
            )
            ->columns([
                TextColumn::make('nama_pembangunan')->label('Nama Program'),
                TextColumn::make('status')->badge()->label('Status'),
                TextColumn::make('estimasi_biaya')->label('Target')->money('IDR', true)->placeholder('Tidak ada target'),
                ProgressBar::make('progress_program')
                    ->label('Dana Donasi')
                    ->getStateUsing(function (m_program_pembangunan $record){
                        $total = $record->estimasi_biaya;
                        $progress = $record->hitungTotalDonasiTerkumpul();
                        return [
                            'total' => $total,
                            'progress' => $progress,
                        ];
                    }),
            ])
            ->actions([
                ViewAction::make('detail')
                    ->label('Lihat Program')
                    ->modalHeading('Detail Program Pembangunan')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->infolist(ProgramPembangunanResource::getInfolistSchema()),
                Action::make('donasi')
                    ->label('Donasi Sekarang')
                    ->color('success')
                    ->icon('heroicon-o-document')
                    ->url(fn ($record) => route('filament.admin.resources.transaksi-donasi-programs.create', [
                        'program_id' => $record->id,
                    ]
                    )),
            ]);
            
    }
}
