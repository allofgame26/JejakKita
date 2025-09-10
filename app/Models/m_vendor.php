<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class m_vendor extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'kode_vendor',
        'nama_vendor',
        'alamat_vendor',
        'no_telepon',
        'keterangan',
        'status',
    ];

    public function mBarangs(): BelongsToMany
    {
        return $this->belongsToMany(m_barang::class,'t_transaksi_barangs','barang_id','vendor_id')->withPivot('jumlah_dibeli','harga_satuan','tanggal_beli','status_pembayaran');
    }
}
