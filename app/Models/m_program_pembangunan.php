<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class m_program_pembangunan extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'mandor_id',
        'kode_program',
        'nama_pembangunan',
        'estimasi_tanggal_selesai',
        'tanggal_mulai',
        'tanggal_selesai_aktual',
        'estimasi_biaya',
        'status',
        'deskripsi',
    ];

    public function mandor(): BelongsTo
    {
        return $this->belongsTo(m_mandor::class,'mandor_id','id');
    }

    public function barang()
    {
        return $this->belongsToMany(m_barang::class,'t_kebutuhan_barang_programs','program_id','barang_id')->withPivot('jumlah_barang','status','keterangan');
    }

    public function donasiprogram(): HasMany
    {
        return $this->hasMany(t_transaksi_donasi_program::class);
    }

    public function priority(): BelongsToMany
    {
        return $this->belongsToMany(Priority::class,'priority_pembangunans','program_id','priority_id')->withPivot('nilai_priority');
    }

    public function sawScore(): float
    {
        $kriteria = Priority::all()->keyBy('id');

        $nilaiMentah = Priority_Pembangunan::where('program_id', $this->id)->get();

        if ($kriteria->isEmpty() || $nilaiMentah->isEmpty()) {
            return 0.0;
        }

        $maxMinValues = [];

        foreach ($kriteria as $k){
            $query = Priority_Pembangunan::where('priority_id', $k->id);
            if($k->jenis_kriteria == 'benefit'){
                $maxMinValues[$k->id] = $query->max('nilai_priority');
            } else {
                $maxMinValues[$k->id] = $query->min('nilai_priority');
            }
        }

        $skorTotal = 0;

        foreach ($nilaiMentah as $nilai){
            $kriteriaDetail = $kriteria[$nilai->priority_id];
            $nilaiPrioritas = $nilai->nilai_priority;

            $nilaiTernormalisasi = 0;


            if($nilaiPrioritas > 0 && isset($maxMinValues[$nilai->priority_id])){
                if ($kriteriaDetail->jenis_kriteria == 'benefit'){
                    $nilaiTernormalisasi = $nilaiPrioritas / $maxMinValues[$nilai->priority_id];
                } else {
                    $nilaiTernormalisasi = $maxMinValues[$nilai->priority_id] / $nilaiPrioritas;
                }
            }

            $bobot = $kriteriaDetail->persen_priority / 100;
            $skorTotal += $bobot * $nilaiTernormalisasi;
        }

        return round($skorTotal, 2);
    }
    


}
