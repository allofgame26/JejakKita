<?php

namespace App\Observers;

use App\Models\t_transaksi_donasi_spesifik;

class KodeTransaksiSpesifik
{
    /**
     * Handle the t_transaksi_donasi_spesifik "created" event.
     */
    public function created(t_transaksi_donasi_spesifik $t_transaksi_donasi_spesifik): void
    {
        //
    }

    public function creating(t_transaksi_donasi_spesifik $t_transaksi_donasi_spesifik):void
    {
        do {
            $nomorrandom = mt_rand(1000,9999);
            $tanggalcode = date('ymd');

            $code = 'SP-' . $nomorrandom . '-' . $tanggalcode;

            $cekCode = t_transaksi_donasi_spesifik::where('kode_transaksi', $code)->exists();
        } while ($cekCode);

        $t_transaksi_donasi_spesifik->kode_transaksi = $code;
    }

    /**
     * Handle the t_transaksi_donasi_spesifik "updated" event.
     */
    public function updated(t_transaksi_donasi_spesifik $t_transaksi_donasi_spesifik): void
    {
        //
    }

    /**
     * Handle the t_transaksi_donasi_spesifik "deleted" event.
     */
    public function deleted(t_transaksi_donasi_spesifik $t_transaksi_donasi_spesifik): void
    {
        //
    }

    /**
     * Handle the t_transaksi_donasi_spesifik "restored" event.
     */
    public function restored(t_transaksi_donasi_spesifik $t_transaksi_donasi_spesifik): void
    {
        //
    }

    /**
     * Handle the t_transaksi_donasi_spesifik "force deleted" event.
     */
    public function forceDeleted(t_transaksi_donasi_spesifik $t_transaksi_donasi_spesifik): void
    {
        //
    }
}
