<?php

namespace App\Http\Controllers;

use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KwitansiController extends Controller
{
    public function downloadProgram(t_transaksi_donasi_program $transaksi){
        $pdf = Pdf::loadView('filament.kwitansi.pdfProgram', ['transaksi' => $transaksi]);

        $namaFile = 'kwitansi' . $transaksi->user->name . '.pdf';

        return $pdf->download($namaFile);
    }

    public function downloadSpesifikasi(t_transaksi_donasi_spesifik $transaksi){
        $pdf = Pdf::loadView('filament.kwitansi.pdfSpesifikasi', ['transaksi' => $transaksi]);

        $namaFile = 'kwitansi-spesifik' . $transaksi->user->name . '.pdf';

        return $pdf->download($namaFile);
    }
}
