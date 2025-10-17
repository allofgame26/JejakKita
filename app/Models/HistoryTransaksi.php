<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryTransaksi extends Model
{
    use HasFactory;

    protected $table = 'history_transaksi';

    public $incrementing = false;

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function metodePembayaran():BelongsTo
    {
        return $this->belongsTo(m_metode_pembayaran::class, 'pembayaran_id','id');
    }
}
