<?php

namespace App\Observers;

use App\Models\t_kebutuhan_barang_program;
use App\Models\t_transaksi_barang;

class DoneTransaksiBarangObserver
{
    /**
     * Handle the t_transaksi_barang "created" event.
     */
    public function created(t_transaksi_barang $t_transaksi_barang): void
    {
        //
    }

    /**
     * Handle the t_transaksi_barang "updated" event.
     */
    public function updated(t_transaksi_barang $t_transaksi_barang): void
    {
        if ($t_transaksi_barang->kebutuhan_id && $t_transaksi_barang->wasChanged('status_pembayaran') && $t_transaksi_barang->status_pembayaran === 'sukses'){
            $kebutuhan = t_kebutuhan_barang_program::find($t_transaksi_barang->kebutuhan_id);
            if ($kebutuhan){
                $kebutuhan->increment('jumlah_terpenuhi', $t_transaksi_barang->jumlah_dibeli);

                if ($kebutuhan->jumlah_terpenuhi >= $kebutuhan->jumlah_barang){
                    $kebutuhan->status_pembelian = 'tersedia';
                    $kebutuhan->status = 'selesai';
                    $kebutuhan->save();
                }
            }
        }
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
