<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class m_program_pembangunan extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'mandor_id',
        'kode_program',
        'nama_pembangunan',
        'estimasi_tanggal_selesai',
        'tanggal_mulai',
        'tanggal_selesai_aktual',
        'estimasi_biaya',
        'status',
        'deskripsi',
    ];

    public function mandor(): BelongsTo
    {
        return $this->belongsTo(m_mandor::class,'mandor_id','id');
    }

    public function barang()
    {
        return $this->belongsToMany(m_barang::class,'t_kebutuhan_barang_programs','program_id','barang_id')->withPivot('jumlah_barang','status','keterangan');
    }

    public function donasiprogram(): HasMany
    {
        return $this->hasMany(t_transaksi_donasi_program::class);
    }
}
