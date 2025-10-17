<?php

namespace App\Http\Controllers;

use App\Models\HistoryTransaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function downloadHistoryTransaksi()
    {
        $transaksi = HistoryTransaksi::where('status_pembayaran', 'sukses')->get();
        $pdf = Pdf::loadView('filament.laporan.laporanRealtime', ['transaksi' => $transaksi]);
        return $pdf->download('history-transaksi-per-'.date('d-m-Y').'.pdf');
    }
}
