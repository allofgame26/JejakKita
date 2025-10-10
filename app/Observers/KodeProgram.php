<?php

namespace App\Observers;

use App\Models\m_program_pembangunan;

class KodeProgram
{
    /**
     * Handle the m_program_pembangunan "created" event.
     */
    public function creating(m_program_pembangunan $m_program_pembangunan): void
    {
        $cekID = m_program_pembangunan::max('id') ?? 0;
        $nextID = $cekID + 1;

        $kodeProgram = 'PRG-' . $nextID . '-' . date('ym');

        $m_program_pembangunan->kode_program = $kodeProgram;
    }

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
        //
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
}
