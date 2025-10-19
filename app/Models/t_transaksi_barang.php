<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class t_transaksi_barang extends Pivot implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'vendor_id',
        'barang_id',
        'jumlah_dibeli',
        'harga_satuan',
        'tanggal_beli',
        'status_pembayaran',
    ];

    protected $table = 't_transaksi_barangs';

    public function barang(): BelongsTo
    {
        return $this->belongsTo(m_barang::class,'barang_id','id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(m_vendor::class,'vendor_id','id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('conversion')
            ->quality(80)
            ->withResponsiveImages();
    }
}
