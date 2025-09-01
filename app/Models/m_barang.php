<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class m_barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategoribarang_id',
        'nama_barang',
        'kode_barang',
        'nama_satuan',
        'deskripsi_barang',
    ];

    public function kategoriBarang(): BelongsTo
    {
        return $this->belongsTo(m_kategori_barang::class,'kategoribarang_id','id');
    }

    public function mProgramPembangunans()
    {
        return $this->belongsToMany(m_program_pembangunan::class,'t_kebutuhan_barang_programs','barang_id','program_id')->withPivot('jumlah_barang');
    }

    public function vendor(): BelongsToMany
    {
        return $this->belongsToMany(m_vendor::class,'t_transaksi_barangs','vendor_id','barang_id')->withPivot('jumlah_dibeli','harga_satuan','tanggal_beli');
    }
    
}
