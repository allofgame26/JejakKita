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
             if($transaksi->wasChanged('status_pembayaran') && $transaksi->status_pembayaran === 'sukses')

                $transaksi->program->periksaKebutuhanDanKirimNotifikasi();

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
    public function creating(Model $transaksi)
    {
        if ($transaksi instanceof t_transaksi_donasi_program){
                do {
                $nomorrandom = mt_rand(1000,9999);
                $tanggalcode = date('ymd');

                $code = 'DP-'.$nomorrandom.'-'.$tanggalcode;

                $cekCode = t_transaksi_donasi_program::where('kode_transaksi', $code)->exists();
            } while ($cekCode);

            $transaksi->kode_transaksi = $code;

            $transaksi->status_pembayaran = 'pending'; // untuk widget Program Pembangunan

            $transaksi->user_id = Auth()->id(); // untuk Widget Program Pembangunan
        } elseif ($transaksi instanceof t_transaksi_donasi_spesifik){
                do {
                $nomorrandom = mt_rand(1000,9999);
                $tanggalcode = date('ymd');

                $code = 'SP-' . $nomorrandom . '-' . $tanggalcode;

                $cekCode = t_transaksi_donasi_spesifik::where('kode_transaksi', $code)->exists();
            } while ($cekCode);

            $transaksi->kode_transaksi = $code;
        }
    }
}