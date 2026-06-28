<?php

namespace App\Observers;

use App\Jobs\prosesEmbeddingRAG;
use App\Models\m_dokumen;

class MasterDokumenEmbedding
{
    /**
     * Handle the m_dokumen "created" event.
     */
    public function created(m_dokumen $m_dokumen): void
    {
        prosesEmbeddingRAG::dispatch($m_dokumen);
    }

    /**
     * Handle the m_dokumen "updated" event.
     */
    public function updated(m_dokumen $m_dokumen): void
    {
        //
    }

    /**
     * Handle the m_dokumen "deleted" event.
     */
    public function deleted(m_dokumen $m_dokumen): void
    {
        //
    }

    /**
     * Handle the m_dokumen "restored" event.
     */
    public function restored(m_dokumen $m_dokumen): void
    {
        //
    }

    /**
     * Handle the m_dokumen "force deleted" event.
     */
    public function forceDeleted(m_dokumen $m_dokumen): void
    {
        //
    }
}
