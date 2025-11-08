<?php

namespace App\Observers;

use App\Models\m_vendor;

class KodeVendor
{
    /**
     * Handle the m_vendor "created" event.
     */
    public function created(m_vendor $m_vendor): void
    {
        // $kodeVendor = 'VDR-' . $m_vendor->id . '-' . date('ym');
    }

    public function creating(m_vendor $m_vendor): void
    {
        $jumlahVendor = m_vendor::where('nama_vendor', $m_vendor->nama_vendor)->count();

        $kodeVendor = 'VDR-' . $jumlahVendor . '-' . date('ym');

        $m_vendor->kode_vendor = $kodeVendor;
    }

    /**
     * Handle the m_vendor "updated" event.
     */
    public function updated(m_vendor $m_vendor): void
    {
        //
    }

    /**
     * Handle the m_vendor "deleted" event.
     */
    public function deleted(m_vendor $m_vendor): void
    {
        //
    }

    /**
     * Handle the m_vendor "restored" event.
     */
    public function restored(m_vendor $m_vendor): void
    {
        //
    }

    /**
     * Handle the m_vendor "force deleted" event.
     */
    public function forceDeleted(m_vendor $m_vendor): void
    {
        //
    }
}
