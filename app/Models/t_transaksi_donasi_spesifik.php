<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class t_transaksi_donasi_spesifik extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'pembayaran_id',
        'jumlah_donasi',
        'status_pembayaran',
        'status_kirim_bukti_pembayaran',
        'pesan_donatur',
    ];

    public function kebutuhan(): BelongsToMany
    {
        return $this->belongsToMany(t_kebutuhan_barang_program::class,'donasi_kebutuhans','donasi_id','kebutuhan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(m_metode_pembayaran::class);
    }

    public function program()
    {

        return $this->hasOneThrough(
            m_program_pembangunan::class,
            t_kebutuhan_barang_program::class,
            'id','id','kebutuhan_id','program_id'
        );
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('conversion')
            ->quality(80)
            ->withResponsiveImages();
    }

}
