<?php

namespace App\Observers;

use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Illuminate\Database\Eloquent\Model;

class TransaksiDonasiObserver
{
    public function saved(Model $transaksi)
    {
        // melakukan pengecekan untuk Goal Donasi apakah sudah tercapai atau belum.
        if ($transaksi instanceof t_transaksi_donasi_program){
             if($transaksi->status_pembayaran === 'sukses') {
                $transaksi->program->cekDanUpdateStatus();
        } elseif ($transaksi instanceof t_transaksi_donasi_spesifik){
             if ($transaksi->status_pembayaran === 'sukses' && $transaksi->wasChanged('status_pembayaran')){
                $transaksi->load('kebutuhan.program');

                $program = $transaksi->kebutuhan?->program;

                if($program){
                    $program->cekDanUpdateStatus();
                }
            }
        }
    }
        
    }
}