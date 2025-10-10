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
        //
    }

    /**
     * Handle the t_transaksi_barang "updated" event.
     */
    public function updated(t_transaksi_barang $t_transaksi_barang): void
    {
        if ($t_transaksi_barang->wasChanged('status_pembayaran') && $t_transaksi_barang->status_pembayaran === 'berhasil'){

            $kebutuhanTerkait = t_kebutuhan_barang_program::where('barang_id', $t_transaksi_barang->barang_id)->where('status_pembelian', 'belum_tersedia')->orderBy('id','asc')->get();

            $jumlahDibeli = $t_transaksi_barang->jumlah_dibeli;

             foreach ($kebutuhanTerkait as $kebutuhan){

                //mengecek berapa yang dibutuhkan
                $sisa_kebutuhan = $kebutuhan->jumlah_barang - $kebutuhan->jumlah_terpenuhi;
                $jumlahUntukDipenuhi = min($jumlahDibeli, $sisa_kebutuhan); //berapa banyak yang bisa dipenuhi dari pembelian

                $kebutuhan->jumlah_terpenuhi += $jumlahUntukDipenuhi; //Menambahkan jumalh_terpenuhi
                $jumlahDibeli -= $jumlahUntukDipenuhi; // mengurangi jumlah yang tersedia dari transaksi ini

                if ($kebutuhan->jumlah_terpenuhi >= $kebutuhan->jumlah_barang){
                    $kebutuhan->status_pembelian = 'tersedia';
                    $kebutuhan->status = 'diambil';
                } else {
                    $kebutuhan->status_pembelian = 'belum_tersedia';
                }

                $kebutuhan->save();

                if ($jumlahDibeli <= 0){
                    break;
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
