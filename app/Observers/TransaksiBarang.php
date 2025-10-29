<?php

namespace App\Observers;

use App\Models\m_barang;
use App\Models\Pengeluaran;
use App\Models\t_kebutuhan_barang_program;
use App\Models\t_transaksi_barang;
use App\Models\t_transaksi_donasi_program;
use App\Models\t_transaksi_donasi_spesifik;
use Illuminate\Database\Eloquent\Model;

class TransaksiBarang
{
    /**
     * Handle the t_transaksi_barang "created" event.
     */
    public function created(t_transaksi_barang $t_transaksi_barang): void
    {
        $barangid = $t_transaksi_barang->barang_id;

        $harga_avg = t_transaksi_barang::where('barang_id', $barangid)->avg('harga_satuan');

        $barang = m_barang::find($barangid);

        if ($barang){
            $barang->harga_rata = $harga_avg;
            $barang->save();
        }
        
    }

    /**
     * Handle the t_transaksi_barang "updated" event.
     */
    public function updated(t_transaksi_barang $t_transaksi_barang): void
    {
        if ($t_transaksi_barang->isDirty('status_pembayaran') && $t_transaksi_barang->status_pembayaran === 'berhasil')
        {
                Pengeluaran::create([
                    'tanggal' => $t_transaksi_barang->tanggal_beli,
                    'kategori' => 'Pembelian Material',
                    'deskripsi' => "Pembelian {$t_transaksi_barang->jumlah_dibeli} {$t_transaksi_barang->barang->nama_satuan} {$t_transaksi_barang->barang->nama_barang} dari {$t_transaksi_barang->vendor->nama_vendor}",
                    'jumlah' => $t_transaksi_barang->jumlah_dibeli * $t_transaksi_barang->harga_satuan,
                    'sumber_type' => t_transaksi_barang::class,
                    'sumber_id' => $t_transaksi_barang->id,
                    'program_id' => $t_transaksi_barang->kebutuhanBarang->program_id,
                ]);
        }

         if ($t_transaksi_barang->kebutuhan_id && $t_transaksi_barang->wasChanged('status_pembayaran') && $t_transaksi_barang->status_pembayaran === 'sukses'){
            $kebutuhan = t_kebutuhan_barang_program::find($t_transaksi_barang->kebutuhan_id);
            if ($kebutuhan){
                $kebutuhan->increment('jumlah_terpenuhi', $t_transaksi_barang->jumlah_dibeli);

                if ($kebutuhan->jumlah_terpenuhi >= $kebutuhan->jumlah_barang){
                    $kebutuhan->status_pembelian = 'tersedia';
                    $kebutuhan->status = 'selesai';
                    $kebutuhan->save();
                }
            }
        }

        if ($t_transaksi_barang->wasChanged('status_pembayaran') && $t_transaksi_barang->status_pembayaran === 'berhasil'){

            $kebutuhanTerkait = t_kebutuhan_barang_program::where('barang_id', $t_transaksi_barang->barang_id)->where('status_pembelian', 'belum_tersedia')->orderBy('id','asc')->get();

            $jumlahDibeli = $t_transaksi_barang->jumlah_dibeli;

             foreach ($kebutuhanTerkait as $kebutuhan){

                //mengecek berapa yang dibutuhkan
                $sisa_kebutuhan = $kebutuhan->jumlah_barang - $kebutuhan->jumlah_terpenuhi;
                $jumlahUntukDipenuhi = min($jumlahDibeli, $sisa_kebutuhan); //berapa banyak yang bisa dipenuhi dari pembelian

                $kebutuhan->jumlah_terpenuhi += $jumlahUntukDipenuhi; //Menambahkan jumalh_terpenuhi dari barang yang baru dibeli
                $jumlahDibeli -= $jumlahUntukDipenuhi; // mengurangi jumlah yang tersedia dari transaksi ini

                if ($kebutuhan->jumlah_terpenuhi >= $kebutuhan->jumlah_barang){
                    $kebutuhan->status_pembelian = 'tersedia';
                    $kebutuhan->status = 'diambil';
                } else {
                    $kebutuhan->status_pembelian = 'belum_tersedia';
                }

                $kebutuhan->save();

                if ($jumlahDibeli <= 0){
                    break;
                }
            }
        }
    }

    /**
     * Handle the t_transaksi_barang "deleted" event.
     */
    public function deleted(t_transaksi_barang $t_transaksi_barang): void
    {
        //
    }

    /**
     * Handle the t_transaksi_barang "restored" event.
     */
    public function restored(t_transaksi_barang $t_transaksi_barang): void
    {
        //
    }

    /**
     * Handle the t_transaksi_barang "force deleted" event.
     */
    public function forceDeleted(t_transaksi_barang $t_transaksi_barang): void
    {
        //
    }
}
