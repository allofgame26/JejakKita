<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class t_kebutuhan_barang_program extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_barang',
        'status',
        'keterangan',
        'barang_id',
        'program_id',
        'status_pembelian',
        'jumlah_terpenuhi',
    ];

    protected $table = 't_kebutuhan_barang_programs';

    public function barang(): BelongsTo
    {
        return $this->belongsTo(m_barang::class, 'barang_id', 'id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(m_program_pembangunan::class, 'program_id', 'id');
    }

    public function donasispesifik(): HasMany
    {
        return $this->hasMany(t_transaksi_donasi_spesifik::class);
    }

    public function donasi(): BelongsToMany
    {
        return $this->belongsToMany(t_transaksi_donasi_spesifik::class,'donasi_kebutuhans','donasi_id','kebutuhan_id');
    }

    public function getNamaBarangAttribute()
    {
        return $this->barang?->nama_barang;
    }

    
}
