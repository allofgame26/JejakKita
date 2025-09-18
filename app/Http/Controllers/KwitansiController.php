<?php

namespace App\Http\Controllers;

use App\Models\t_transaksi_donasi_program;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KwitansiController extends Controller
{
    public function downloadProgram(t_transaksi_donasi_program $transaksi){
        $pdf = Pdf::loadView('filament.kwitansi.pdfProgram', ['transaksi' => $transaksi]);

        $namaFile = 'kwitansi' . $transaksi->id . '.pdf';

        return $pdf->download($namaFile);
    }
}
