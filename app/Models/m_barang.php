<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class m_barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategoribarang_id',
        'kode_barang',
        'nama_barang',
        'nama_satuan',
        'harga_satuan',
        'jumlah_barang_dibutuhkan',
        'deskripsi_barang',
    ];

    public function kategoriBarang(): BelongsTo
    {
        return $this->belongsTo(m_kategori_barang::class,'kategoribarang_id','id');
    }
}
