<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pengeluaran extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'tanggal',
        'kategori',
        'deskripsi',
        'jumlah',
        'sumber_type',
        'sumber_id',
        // 'program_id',
    ];

    // public function program()
    // {
    //     return $this->belongsTo(m_program_pembangunan::class,'program_id','id');
    // }
}
