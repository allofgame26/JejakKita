<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Priority extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_priority',
        'persen_priority',
        'deskripsi_priority',
        'jenis_kriteria'
    ];

    public function mProgramPembangunans(): BelongsToMany
    {
        return $this->belongsToMany(m_program_pembangunan::class,'priority_pembangunans','priority_id','program_id')->withPivot('nilai_priority');
    }
    
}
