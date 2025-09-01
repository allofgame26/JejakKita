<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class m_periode extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_periode',
        'tahun_mulai',
        'tahun_selesai',
        'status',
    ];

    public function program(): HasMany
    {
        return $this->hasMany(m_program_pembangunan::class);
    }
}
