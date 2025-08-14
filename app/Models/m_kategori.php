<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class m_kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    public function post(): BelongsToMany
    {
        return $this->belongsToMany(m_post::class,'m_kategori_posts','kategori_id','post_id');
    }
    
}
