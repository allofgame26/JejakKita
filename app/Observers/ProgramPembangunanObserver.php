<?php

namespace App\Observers;

use App\Models\m_program_pembangunan;
use App\Models\Priority;
use App\Models\Priority_Pembangunan;
use App\Services\PerhitunganSAW;
use Illuminate\Support\Facades\DB;

class ProgramPembangunanObserver
{

    /**
     * Handle the m_program_pembangunan "updated" event.
     */
    public function updated(m_program_pembangunan $m_program_pembangunan): void
    {
        //
    }

    /**
     * Handle the m_program_pembangunan "deleted" event.
     */
    public function deleted(m_program_pembangunan $m_program_pembangunan): void
    {
        (new PerhitunganSAW())->perhitunganSemua();
    }

    /**
     * Handle the m_program_pembangunan "restored" event.
     */
    public function restored(m_program_pembangunan $m_program_pembangunan): void
    {
        //
    }

    /**
     * Handle the m_program_pembangunan "force deleted" event.
     */
    public function forceDeleted(m_program_pembangunan $m_program_pembangunan): void
    {
        //
    }

    // public function saving(m_program_pembangunan $programPembangunan)
    // {
    //     $bobotPrioritas = Priority::all()->pluck('persen_priority','id');

    //     $skorInputs = DB::table('priority_pembangunans')
    //                     ->where('program_id', $programPembangunan->id)
    //                     ->pluck('nilai_priority', 'priority_id');

    //     $totalSkorAkhir = 0;

    //     foreach ($skorInputs as $priorityId => $nilaiSkor){
    //         if (isset($bobotPrioritas[$priorityId])) {
    //             $bobot = $bobotPrioritas[$priorityId] / 100;
    //             $totalSkorAkhir += ($nilaiSkor * $bobot);
    //         }
    //     }

    //     $programPembangunan->skor_prioritas_akhir = $totalSkorAkhir;
    // }
}
