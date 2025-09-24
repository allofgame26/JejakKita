<?php

namespace App\Observers;

use App\Models\Priority_Pembangunan;
use App\Services\PerhitunganSAW;

class PriorityPembangunanObserver
{
    /**
     * Handle the Priority_Pembangunan "created" event.
     */
    public function created(Priority_Pembangunan $priority_Pembangunan): void
    {
        //
    }

    /**
     * Handle the Priority_Pembangunan "updated" event.
     */
    public function updated(Priority_Pembangunan $priority_Pembangunan): void
    {
        //
    }

    /**
     * Handle the Priority_Pembangunan "deleted" event.
     */
    public function deleted(Priority_Pembangunan $pivot): void
    {
        (new PerhitunganSAW())->perhitunganSemua();
    }

    /**
     * Handle the Priority_Pembangunan "restored" event.
     */
    public function restored(Priority_Pembangunan $priority_Pembangunan): void
    {
        //
    }

    /**
     * Handle the Priority_Pembangunan "force deleted" event.
     */
    public function forceDeleted(Priority_Pembangunan $priority_Pembangunan): void
    {
        //
    }

    public function saved(Priority_Pembangunan $pivot):void
    {
        (new PerhitunganSAW())->perhitunganSemua();
    }
}
