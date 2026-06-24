<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class dokumen_rag extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'id_file',
        'embedding',
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(m_dokumen::class, 'id_file');
    }
}
