<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class m_kategori_post extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'post_id',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(m_post::class,'post_id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(m_kategori_post::class,'kategori_id');
    }
}
