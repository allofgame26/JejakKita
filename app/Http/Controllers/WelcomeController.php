<?php

namespace App\Http\Controllers;

use App\Models\m_kategori;
use App\Models\m_program_pembangunan;
use App\Policies\m_kategoriPolicy;
use Illuminate\Http\Request;

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

        return view('welcomes', [
            'daftarKategori' => $semuaKategori,
            'programDonasi' => $programDonasi,
        ]);
    }
}
