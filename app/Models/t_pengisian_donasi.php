<?php
namespace App\Models;

use Filament\Pages\Concerns\InteractsWithHeaderActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\InteractsWithMedia;

class t_pengisian_donasi extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 't_pengisian_donasi';

    protected $fillable = [
        'nama_lengkap_donatur',
        'pembayaran_id',
        'jumlah_donasi',
        'bukti_pembayaran',
        'pesan_donatur',
    ];

    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(m_metode_pembayaran::class);
    }
}
