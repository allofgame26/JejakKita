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

    protected $fillable = [
        'id_program',
        'id_user',
        'id_metode_pembayaran',
        'jumlah_donasi',
        'status_pembayaran',
        'pesan_donatur',
    ];

    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(m_metode_pembayaran::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(m_program_pembangunan::class);
    }
}
