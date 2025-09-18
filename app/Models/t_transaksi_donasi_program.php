<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class t_transaksi_donasi_program extends Model implements HasMedia
{
    use HasFactory;

    use InteractsWithMedia;

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

    protected $fillable = [
        'program_id',
        'user_id',
        'pembayaran_id',
        'jumlah_donasi',
        'status_pembayaran',
        'status_kirim_bukti_pembayaran',
        'pesan_donatur',
    ];

    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(m_metode_pembayaran::class, 'pembayaran_id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(m_program_pembangunan::class, 'program_id');
    }

    public static function dataDiri()
    {
        return self::with('user.datadiri')->get();
    }

}
