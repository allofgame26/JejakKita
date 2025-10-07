<?php

namespace App\Services;

use App\Models\m_program_pembangunan;
use App\Models\Priority;
use Illuminate\Support\Facades\DB;

class PerhitunganSAW
{
    public function perhitunganSemua():void
    {
        $programs = m_program_pembangunan::all();
        $priorities = Priority::all()->keyBy('id');
        $allScore = DB::table('priority_pembangunans')->get()->groupBy('program_id');

        if($programs->isEmpty() || $priorities->isEmpty()){
            return ;
        }

        $tipeKriteria = $priorities->pluck('jenis_kriteria','id');
        $bobot = $priorities->pluck('persen_priority','id');

        $matrix = [];
        $nilaiMax = [];
        $nilaiMin = [];

        foreach ($programs as $program) {
            foreach ($priorities as $priority) {
                $score = $allScore[$program->id]->firstWhere('priority_id', $priority->id)->nilai_priority ?? 0;
                $decisionMatrix[$program->id][$priority->id] = $score;

                // inisialisasi nilai max/min
                if (!isset($nilaiMax[$priority->id])) $nilaiMax[$priority->id] = $score;
                if (!isset($nilaiMin[$priority->id])) $nilaiMin[$priority->id] = $score;

                //Update nilai max/min
                if ($score > $nilaiMax[$priority->id]) $nilaiMax[$priority->id] = $score;
                if ($score < $nilaiMin[$priority->id]) $nilaiMin[$priority->id] = $score;
            }
        }

        // Normalisasi dan hitung score

        $finalScore = [];
        foreach ($programs as $program) {
            $totalScore = 0;
            foreach ($priorities as $priority) {
                $score = $decisionMatrix[$program->id][$priority->id];
                $normalizedScore = 0;

                //RUmus Normalisasi
                if ($tipeKriteria[$priority->id] === 'benefit') {
                    $normalizedScore = ($nilaiMax[$priority->id] > 0) ? $score / $nilaiMax[$priority->id] : 0;
                } elseif ($tipeKriteria[$priority->id] === 'cost') {
                    $normalizedScore = ($score > 0) ? $nilaiMin[$priority->id] / $score : 0;
                }

                // Perkalian dengan Bobot
                $totalScore += $normalizedScore * ($bobot[$priority->id] / 100);
            }
            $finalScore[$program->id] = $totalScore;
        }
        foreach($finalScore as $programId => $score){
            m_program_pembangunan::where('id',$programId)->update(['skor_prioritas_akhir' => $score]);
        }
    }
}
?>