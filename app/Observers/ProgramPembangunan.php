<?php

namespace App\Observers;

use App\Models\m_program_pembangunan;
use App\Services\PerhitunganSAW;

class ProgramPembangunan
{
    /**
     * Handle the m_program_pembangunan "created" event.
     */
    public function created(m_program_pembangunan $m_program_pembangunan): void
    {
        $kodeProgram = 'PRG-' . $m_program_pembangunan->id . '-' . date('ym');

        // ini adalah function without event untuk menghindari loop tak berujung
        $m_program_pembangunan->withoutEvents(function () use ($m_program_pembangunan, $kodeProgram) {
            $m_program_pembangunan->kode_program = $kodeProgram;
            $m_program_pembangunan->save();
        });
    }

    /**
     * Handle the m_program_pembangunan "updated" event.
     */
    public function updated(m_program_pembangunan $m_program_pembangunan): void
    {
        if ($m_program_pembangunan->status === 'Selesai' && $m_program_pembangunan->wasChanged('status')) {
            $m_program_pembangunan->tanggal_selesai_aktual = now();
            $m_program_pembangunan->save();
        } else {
            $m_program_pembangunan->tanggal_selesai_aktual = null;
            $m_program_pembangunan->save();
        }
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
}
