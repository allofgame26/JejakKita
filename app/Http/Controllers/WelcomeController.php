<?php

namespace App\Http\Controllers;

use App\Models\m_kategori;
use App\Models\m_program_pembangunan;
use App\Policies\m_kategoriPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $semuaKategori = m_kategori::has('posts')->with('posts.media')->orderBy('row','asc')->get();

        $programDonasi = m_program_pembangunan::where('status_pendanaan', '!=' ,'lengkap')->with('media')->orderBy('skor_prioritas_akhir', 'desc')->limit(3)->get()->map(function ($program){
            $terkumpul = $program->hitungTotalDonasiTerkumpul();
            $target = $program->estimasi_biaya;

            $persentase = ($target > 0 ) ? ($terkumpul / $target)* 100 : 0;

            $program->dana_terkumpul = $terkumpul;
            $program->persentase_terkumpul = $persentase;

            return $program;
        });

        $reportFiles = Storage::files('public/laporan');

        $reports = collect($reportFiles)
            ->map(function ($file) {
                // Ekstrak tanggal dari nama file, misal: 'laporan-keuangan-2025-09.pdf'
                preg_match('/(\d{4})-(\d{2})/', $file, $matches);
                
                if (count($matches) === 3) {
                    $date = Carbon::createFromDate($matches[1], $matches[2], 1);
                    return [
                        'url' => Storage::url($file),
                        'name' => 'Laporan ' . $date->translatedFormat('F Y'), // Hasil: "Laporan September 2025"
                        'date' => $date,
                    ];
                }
                return null;
            })
            ->filter() // Hapus file yang namanya tidak cocok
            ->sortByDesc('date');

        return view('welcomes', [
            'daftarKategori' => $semuaKategori,
            'programDonasi' => $programDonasi,
            'reports' => $reports,
        ]);
    }
}
