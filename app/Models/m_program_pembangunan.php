<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        'tipe_donasi',
        'estimasi_tanggal_selesai',
        'tanggal_mulai',
        'tanggal_selesai_aktual',
        'estimasi_biaya',
        'status',
        'deskripsi',
        'skor_prioritas_akhir',
        'status_pendanaan',
        'periode_id'
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
        return $this->hasMany(t_transaksi_donasi_program::class,'program_id');
    }

    public function priority(): BelongsToMany
    {
        return $this->belongsToMany(Priority::class,'priority_pembangunans','program_id','priority_id')->withPivot('nilai_priority');
    }

    public function hitungTotalDonasiTerkumpul()
    {
        $t_transaksi_program = t_transaksi_donasi_program::where([['program_id', $this->id],['status_pembayaran', 'sukses']])->sum('jumlah_donasi');

        $t_transaksi_kebutuhan = t_transaksi_donasi_spesifik::join('donasi_kebutuhans', 't_transaksi_donasi_spesifiks.id','=','donasi_kebutuhans.donasi_id')->join('t_kebutuhan_barang_programs', 'donasi_kebutuhans.kebutuhan_id', '=', 't_kebutuhan_barang_programs.id')->where([['t_kebutuhan_barang_programs.program_id', $this->id],['status_pembayaran','sukses']])->sum('jumlah_donasi');

        return $t_transaksi_program + $t_transaksi_kebutuhan;
    }

    public function cekDanUpdateStatus(): void
    {
        $statusSebelumnya = $this->status_pendanaan;

        $totaldonasi = $this->hitungTotalDonasiTerkumpul();

        if ($totaldonasi >= $this->estimasi_biaya && $statusSebelumnya != 'lengkap'){
            $this->status_pendanaan = 'lengkap';
            $this->saveQuietly();

            $receipt = $this->getAdmin();

            Notification::make()
                ->title('Pendanaan Program Tercapai')
                ->body("Program '{$this->nama_pembangunan}' telah berhasil mencapai targer donasi")
                ->success()
                ->sendToDatabase($receipt)
                ->broadcast($receipt);
        }
    }

    protected function getAdmin()
    {
        return User::role(['Admin','super_admin'])->get();
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(m_periode::class);
    }
    
    public function calculateAndSavePriorityScore(): void
    {

        // dd('Muncul');

        $bobotPrioritas = Priority::all()->pluck('persen_priority','id');

        $skorInputs = DB::table('priority_pembangunans')
                        ->where('program_id', $this->id)
                        ->pluck('nilai_priority', 'priority_id');

        $totalSkorAkhir = 0;

        foreach ($skorInputs as $priorityId => $nilaiSkor){
            if (isset($bobotPrioritas[$priorityId])) {
                $bobot = $bobotPrioritas[$priorityId] / 100;
                $totalSkorAkhir += ($nilaiSkor * $bobot);
            }
        }

        $this->skor_prioritas_akhir = $totalSkorAkhir;
        $this->saveQuietly();
    }

    public function periksaKebutuhanDanKirimNotifikasi()
    {
            $totalDonasiMasuk = $this->donasiprogram()->where('status_pembayaran','sukses')->sum('jumlah_donasi');
            $totalDanaTerpakai = t_transaksi_barang::whereHas('barang.mProgramPembangunans', function ($query) {
                $query->where('program_id', $this->id);
                })->where('status_pembayaran','sukses')->sum(DB::raw('jumlah_dibeli * harga_satuan'));

            $danaTersedia = $totalDonasiMasuk - $totalDanaTerpakai;

            $semuaKebutuhan = t_kebutuhan_barang_program::with('barang')
                ->where('program_id', $this->id)
                ->whereColumn('jumlah_terpenuhi', '<' , 'jumlah_barang')
                ->orderBy('created_at', 'asc')
                ->get();

            foreach ($semuaKebutuhan as $kebutuhan) {
                $hargaEstimasi = $kebutuhan->barang->harga_rata ?? 0;
                if ($hargaEstimasi <= 0) {
                    continue;
                }

                $jumlahDibutuhkan = $kebutuhan->jumlah_barang - $kebutuhan->jumlah_terpenuhi;
                $totalEstimasiBiaya = $jumlahDibutuhkan * $hargaEstimasi;

                if ($danaTersedia <= $totalEstimasiBiaya) {
                    $draftSudahAda = t_transaksi_barang::where('kebutuhan_id', $kebutuhan->id)
                        ->where('status_pembayaran', 'draft_pembelian')
                        ->exists();

                    if (!$draftSudahAda) {
                        t_transaksi_barang::create([
                            'barang_id' => $kebutuhan->barang_id,
                            'status_pembayaran' => 'draft_pembelian',
                            'kebutuhan_id' => $kebutuhan->id,
                        ]);

                        $namaBarang = $kebutuhan->barang->nama_barang ?? 'Barang Tidak Diketahui';
                        $receipt = $this->getAdmin();

                        Notification::make()
                            ->title('Dana Tersedia untuk Pembelian Barang Material')
                            ->body("Dana untuk Program '{$this->nama_pembangunan}' membutuhkan pembelian {$jumlahDibutuhkan} unit {$namaBarang}. Silakan tinjau dan proses pembelian.")
                            ->warning()
                            ->sendToDatabase($receipt)
                            ->broadcast($receipt);
                    }
                }
            }
    }
} 
