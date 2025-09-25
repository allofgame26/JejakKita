<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Backstage\TwoFactorAuth\Enums\TwoFactorType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use InteractsWithMedia;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'datadiri_id',
        'two_factor_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     * 
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function datadiri(): BelongsTo
    {
        return $this->belongsTo(m_data_diri::class,'datadiri_id');
    }

    public function getProfileUrlAttribute()
    {
        return $this->datadiri?->getFirstMediaUrl();
    }

    public function donasiprogram(): HasMany
    {
        return $this->hasMany(t_transaksi_donasi_program::class);
    }

    public function donasispesifik(): HasMany
    {
        return $this->hasMany(t_transaksi_donasi_spesifik::class);
    }

    public function feedback(): HasMany
    {
        return $this->hasMany(m_feedback::class);
    }
}
