<?php

namespace App\Filament\Resources\HistoryTransaksiResource\Pages;

use App\Filament\Resources\HistoryTransaksiResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ManageHistoryTransaksis extends ManageRecords
{
    protected static string $resource = HistoryTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            ExportAction::make()->exports([
                ExcelExport::make()
                    ->withFilename('Transaksi Donasi '.date('d-M-Y'))
                    ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                    ->withColumns([
                        Column::make('created_at')->heading('Tanggal Transaksi'),
                        Column::make('kode_transaksi')->heading('kode_transaksi'),
                        Column::make('user.name')->heading('E-Mail'),
                        Column::make('user.datadiri.nama_lengkap')->heading('Nama Lengkap'),
                        Column::make('deskripsi')->heading('Nama Pembangunan'),
                        Column::make('jumlah_donasi')->heading('Jumlah Donasi'),
                        Column::make('metodePembayaran.nama_pembayaran')->heading('Nama Pembayarans'),
                    ])
                    ->modifyQueryUsing(fn ($query) => $query->where('status_pembayaran','sukses'))
                ])->label('Export Data Transaksi')
                ->extraAttributes(['data-cy' => 'export-transactions-button']),
            Action::make('downloadPdf')
                ->label('Download PDF')
                ->color('success')
                ->icon('heroicon-o-document-arrow-down')
                ->url(route('download.history.transaksi'))
                ->openUrlInNewTab()
                ->extraAttributes(['data-cy' => 'download-pdf-button']),
        ];
    }
}
