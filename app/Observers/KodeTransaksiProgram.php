<?php

namespace App\Observers;

use App\Models\t_transaksi_donasi_program;

class KodeTransaksiProgram
{
    /**
     * Handle the t_transaksi_donasi_program "created" event.
     */
    public function created(t_transaksi_donasi_program $t_transaksi_donasi_program): void
    {
        //
    }

    public function creating(t_transaksi_donasi_program $t_transaksi_donasi_program):void
    {
        do {
            $nomorrandom = mt_rand(1000,9999);
            $tanggalcode = date('ymd');

            $code = 'DP-'.$nomorrandom.'-'.$tanggalcode;

            $cekCode = t_transaksi_donasi_program::where('kode_transaksi', $code)->exists();
        } while ($cekCode);

        $t_transaksi_donasi_program->kode_transaksi = $code;
    }
    /**
     * Handle the t_transaksi_donasi_program "updated" event.
     */
    public function updated(t_transaksi_donasi_program $t_transaksi_donasi_program): void
    {
        //
    }

    /**
     * Handle the t_transaksi_donasi_program "deleted" event.
     */
    public function deleted(t_transaksi_donasi_program $t_transaksi_donasi_program): void
    {
        //
    }

    /**
     * Handle the t_transaksi_donasi_program "restored" event.
     */
    public function restored(t_transaksi_donasi_program $t_transaksi_donasi_program): void
    {
        //
    }

    /**
     * Handle the t_transaksi_donasi_program "force deleted" event.
     */
    public function forceDeleted(t_transaksi_donasi_program $t_transaksi_donasi_program): void
    {
        //
    }
}
