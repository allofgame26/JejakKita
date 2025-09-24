<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_transaksi_barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('barang_id');
            $table->integer('jumlah_dibeli');
            $table->string('harga_satuan');
            $table->date('tanggal_beli');
            $table->enum('status_pembayaran',['pending','berhasil','gagal']);
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('m_vendors');
            $table->foreign('barang_id')->references('id')->on('m_barangs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_transaksi_barangs');
    }
};
