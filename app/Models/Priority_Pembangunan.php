<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Priority_Pembangunan extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'priority_id',
        'nilai_priority'
    ];

    public function program():BelongsTo
    {
        return $this->belongsTo(m_program_pembangunan::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }
}
