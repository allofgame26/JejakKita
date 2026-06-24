<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class m_dokumen extends Model
{
    use HasFactory;

    protected $table = 'm_dokumen';

    protected $fillable = [
        'nama_dokumen',
        'id_periode',
        'file_path',
        'is_active',
    ];

    public function periode(): BelongsTo
    {
        return $this->belongsTo(m_periode::class, 'id_periode');
    }

    public function rag(): HasMany
    {
        return $this->hasMany(dokumen_rag::class, 'id_file');
    }
}
