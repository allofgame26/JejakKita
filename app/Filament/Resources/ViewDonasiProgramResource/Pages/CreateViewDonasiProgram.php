<?php

namespace App\Filament\Resources\ViewDonasiProgramResource\Pages;

use App\Filament\Resources\ViewDonasiProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\m_program_pembangunan;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\ViewField;
use IbrahimBougaoua\FilamentProgress\Forms\Components\ProgressBar;
use IbrahimBougaoua\FilaProgress\Tables\Columns\ProgressBar as ColumnsProgressBar;

class CreateViewDonasiProgram extends CreateRecord
{
    protected static string $resource = ViewDonasiProgramResource::class;

    public function getFormSchema(): array
    {
        $program = m_program_pembangunan::find(request()->route('record'));
        $donasiTerkumpul = $program?->donasiprogram?->sum('jumlah_donasi') ?? 0;
        $target = $program?->estimasi_biaya ?? 1;
        $persen = min(100, round($donasiTerkumpul / $target * 100));

        return [
            Card::make()
                ->schema([
                    ViewField::make('nama_pembangunan')
                        ->view('filament.custom.program-nama', compact('program')),
                    ViewField::make('gambar')
                        ->view('filament.custom.program-gambar', compact('program')),
                    ColumnsProgressBar::make('progress')
                        ->label('Sudah Terkumpul')
                        ->value($persen)
                        ->color('success')
                        ->showLabel()
                        ->showValue()
                        ->max(100),
                    ViewField::make('deskripsi')
                        ->view('filament.custom.program-deskripsi', compact('program')),
                ]),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            FormAction::make('donasi')
                ->label('DONASI')
                ->color('primary')
                ->action(fn () => redirect()->route('filament.resources.pengisian-donasi.create')),
        ];
    }
}
