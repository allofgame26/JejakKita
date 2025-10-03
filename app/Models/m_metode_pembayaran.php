<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class m_metode_pembayaran extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'nama_pembayaran',
        'kode_metode_pembayaran',
        'no_rekening',
        'is_open',
        'deskripsi',
    ];

    public function donasispesifik(): HasMany
    {
        return $this->hasMany(t_transaksi_donasi_spesifik::class);
    }

    public function donasiprogram(): HasMany
    {
        return $this->hasMany(t_transaksi_donasi_program::class);
    }
}
