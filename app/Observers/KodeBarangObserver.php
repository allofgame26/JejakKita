<?php

namespace App\Observers;

use App\Models\m_barang;
use App\Models\m_kategori_barang;

class KodeBarangObserver
{
    /**
     * Handle the m_barang "created" event.
     */
    public function created(m_barang $m_barang): void
    {

    }

    public function creating(m_barang $m_barang): void
    {

        $kategori = m_kategori_barang::find($m_barang->kategoribarang_id);

        if ($kategori){
            $kodeKategori = $kategori->kode_kategori;

            $nomorUrut = m_barang::where('kategoribarang_id', $m_barang->kategoribarang_id)->count() + 1;

            $m_barang->kode_barang = $kodeKategori . '-'. $nomorUrut;
        } 
    }


    /**
     * Handle the m_barang "updated" event.
     */
    public function updated(m_barang $m_barang): void
    {
        //
    }

    /**
     * Handle the m_barang "deleted" event.
     */
    public function deleted(m_barang $m_barang): void
    {
        //
    }

    /**
     * Handle the m_barang "restored" event.
     */
    public function restored(m_barang $m_barang): void
    {
        //
    }

    /**
     * Handle the m_barang "force deleted" event.
     */
    public function forceDeleted(m_barang $m_barang): void
    {
        //
    }
}
