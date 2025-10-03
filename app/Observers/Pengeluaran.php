<?php

namespace App\Observers;

use App\Models\Pengeluaran as ModelsPengeluaran;
use App\Models\t_transaksi_barang;

class Pengeluaran
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
        if ($t_transaksi_barang->isDirty('status_pembayaran')&& $t_transaksi_barang->status_pembayaran === 'berhasil')
        {

            $cekBarang = ModelsPengeluaran::where('sumber_type', t_transaksi_barang::class)
                                          ->where('sumber_id', $t_transaksi_barang->id)
                                          ->first();

            if (!$cekBarang){
                ModelsPengeluaran::create([
                'tanggal' => $t_transaksi_barang->tanggal_beli,
                'kategori' => 'Pembelian Material',
                'deskripsi' => "Pembelian {$t_transaksi_barang->jumlah_dibeli} {$t_transaksi_barang->barang->nama_satuan} {$t_transaksi_barang->barang->nama_barang} dari {$t_transaksi_barang->vendor->nama_vendor}",
                'jumlah' => $t_transaksi_barang->jumlah_dibeli * $t_transaksi_barang->harga_satuan,
                'sumber_type' => t_transaksi_barang::class,
                'sumber_id' => $t_transaksi_barang->id,
                ]);
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
