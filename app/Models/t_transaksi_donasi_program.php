<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_transaksi_donasi_program extends Model
{
    use HasFactory;

    public static function getCombinedHistory()
{

    $program = self::with(['program', 'user', 'pembayaran'])
        ->selectRaw('id as transaksi_id, 
        program_id as id_program, 
        user_id as id_user, 
        pembayaran_id as id_metode_pembayaran, 
        null as id_kebutuhan_barang, 
        jumlah_donasi, 
        status_pembayaran, 
        pesan_donatur, 
        created_at, 
        "program" as tipe')
        ->get();

    $spesifik = t_transaksi_donasi_spesifik::with(['barang', 'user', 'pembayaran'])
        ->selectRaw('id as transaksi_id, 
        id_program, id_user, 
        id_metode_pembayaran, 
        id_kebutuhan_barang, 
        null as jumlah_donasi, 
        status_pembayaran, 
        pesan_donatur, 
        created_at, 
        "spesifik" as tipe')
        ->get();
    return $program->concat($spesifik)->sortByDesc('created_at');
}
}

