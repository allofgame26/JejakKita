<?php

namespace App\Observers;

use App\Models\t_kebutuhan_barang_program;
use App\Models\t_transaksi_barang;

class KebutuhanTerpenuhi
{
    /**
     * Handle the t_transaksi_barang "created" event.
     */
    public function created(t_transaksi_barang $t_transaksi_barang): void
    {
        $kebutuhanTerkait = t_kebutuhan_barang_program::where('barang_id', $t_transaksi_barang->barang_id)->where('status_pembelian', '!=', 'belum_tersedia')->orderBy('created_at','asc')->get();

        $jumlah_dibeli = $t_transaksi_barang->jumlah_dibeli;

        foreach ($kebutuhanTerkait as $kebutuhan){
            if ($jumlah_dibeli <= 0){
                break;
            }

            $sisa_kebutuhan = $kebutuhan->jumlah_barang - $kebutuhan->jumlah_terpenuhi;
            $jumlahUntukDipenuhi = min($jumlah_dibeli, $sisa_kebutuhan);

            $kebutuhan->jumlah_terpenuhi += $jumlahUntukDipenuhi;
            $jumlah_dibeli -= $jumlahUntukDipenuhi;

            if ($kebutuhan->jumlah_terpenuhi >= $kebutuhan->jumlah_barang){
                $kebutuhan->status_pembelian = 'tersedia';
            } else {
                $kebutuhan->status_pembelian = 'belum_tersedia';
            }

            $kebutuhan->save();
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
