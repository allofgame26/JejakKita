<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class m_kategori_barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'deskripsi_kategori'
    ];

    public function barang(): HasMany
    {
        return $this->hasMany(m_barang::class);
    }

}
