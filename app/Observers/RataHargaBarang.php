<?php

namespace App\Observers;

use App\Models\m_barang;
use App\Models\t_transaksi_barang;
use Termwind\Components\Dd;

class RataHargaBarang
{
    /**
     * Handle the t_transaksi_barang "created" event.
     */
    public function created(t_transaksi_barang $t_transaksi_barang): void
    {
        $barangid = $t_transaksi_barang->barang_id;

        $harga_avg = t_transaksi_barang::where('barang_id', $barangid)->avg('harga_satuan');

        $barang = m_barang::find($barangid);

        if ($barang){
            $barang->harga_rata = $harga_avg;
            $barang->save();
        }
    }

    /**
     * Handle the t_transaksi_barang "updated" event.
     */
    public function updated(t_transaksi_barang $t_transaksi_barang): void
    {
        //
    }

    /**
     * Handle the t_transaksi_barang "deleted" event.
     */
    public function deleted(t_transaksi_barang $t_transaksi_barang): void
    {
        //
    }

    /**
     * Handle the t_transaksi_barang "restored" event.
     */
    public function restored(t_transaksi_barang $t_transaksi_barang): void
    {
        //
    }

    /**
     * Handle the t_transaksi_barang "force deleted" event.
     */
    public function forceDeleted(t_transaksi_barang $t_transaksi_barang): void
    {
        //
    }
}
