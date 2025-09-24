<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class m_post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'meta_description',
        'slug',
        'user_id',
        'is_published',
    ];

    public function kategori(): BelongsToMany
    {
        return $this->belongsToMany(m_kategori::class,'m_kategori_posts','post_id','kategori_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('fitur_image')->singleFile(); // Untuk foto utama
        $this->addMediaCollection('galeri_images'); // Untuk banyak foto galeri
    }
}
