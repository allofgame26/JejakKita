<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class t_pengisian_donasi extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'donasi_type', // 'program' atau 'spesifik'
        'donasi_id', // ID dari program atau spesifik
        'pembayaran_id',
        'jumlah_donasi',
        'pesan_donatur',
        'tanggal_donasi',
    ];

    protected $casts = [
        'tanggal_donasi' => 'datetime:Y-m-d H:i:s',
        'jumlah_donasi' => 'decimal:2',
    ];

    // Relationship ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship ke Metode Pembayaran
    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(m_metode_pembayaran::class, 'pembayaran_id');
    }

    // Polymorphic relationship untuk donasi (program atau spesifik)
    public function donasi(): MorphTo
    {
        return $this->morphTo('donasi', 'donasi_type', 'donasi_id');
    }

    // Helper method untuk mendapatkan donasi program
    public function donasiProgram(): BelongsTo
    {
        return $this->belongsTo(m_program_pembangunan::class, 'donasi_id');
    }

    // Helper method untuk mendapatkan donasi spesifik
    public function donasiSpesifik(): BelongsTo
    {
        return $this->belongsTo(t_transaksi_donasi_spesifik::class, 'donasi_id');
    }

    // Scope untuk filter berdasarkan jenis donasi
    public function scopeProgram($query)
    {
        return $query->where('donasi_type', 'program');
    }

    public function scopeSpesifik($query)
    {
        return $query->where('donasi_type', 'spesifik');
    }

    // Accessor untuk nama donasi
    public function getNamaDonasi()
    {
        if ($this->donasi_type === 'program') {
            return $this->donasiProgram?->nama_pembangunan ?? 'Program tidak ditemukan';
        } elseif ($this->donasi_type === 'spesifik') {
            return $this->donasiSpesifik?->nama_donasi ?? 'Donasi spesifik tidak ditemukan';
        }
        return 'Jenis donasi tidak valid';
    }
}
