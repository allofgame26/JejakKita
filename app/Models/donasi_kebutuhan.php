<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class donasi_kebutuhan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kebutuhan_id',
        'donasi_id'
    ];

    public function kebutuhan(): BelongsTo
    {
        return $this->belongsTo(t_kebutuhan_barang_program::class,'kebutuhan_id');
    }

    public function donasi(): BelongsTo
    {
        return $this->belongsTo(t_transaksi_donasi_spesifik::class,'donasi_id');
    }
}
