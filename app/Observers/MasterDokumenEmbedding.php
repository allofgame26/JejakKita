<?php

namespace App\Observers;

use App\Models\dokumen_rag;
use App\Jobs\ProsesEmbeddingRAG;

class MasterDokumenEmbedding
{
    /**
     * Handle the dokumen_rag "created" event.
     */
    public function created(dokumen_rag $dokumen_rag): void
    {
        prosesEmbeddingRAG::dispatch($dokumen_rag);
    }

    /**
     * Handle the dokumen_rag "updated" event.
     */
    public function updated(dokumen_rag $dokumen_rag): void
    {
        //
    }

    /**
     * Handle the dokumen_rag "deleted" event.
     */
    public function deleted(dokumen_rag $dokumen_rag): void
    {
        //
    }

    /**
     * Handle the dokumen_rag "restored" event.
     */
    public function restored(dokumen_rag $dokumen_rag): void
    {
        //
    }

    /**
     * Handle the dokumen_rag "force deleted" event.
     */
    public function forceDeleted(dokumen_rag $dokumen_rag): void
    {
        //
    }
}
