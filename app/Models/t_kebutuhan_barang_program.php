<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class t_kebutuhan_barang_program extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_barang',
        'status_pengadaan',
        'keterangan',
        'barang_id',
        'program_id',
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
}
