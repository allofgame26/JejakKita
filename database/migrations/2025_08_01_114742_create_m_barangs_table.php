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
        Schema::create('m_barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategoribarang_id');
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('nama_satuan');
            $table->string('harga_satuan');
            $table->string('jumlah_barang_dibutuhkan');
            $table->string('deskripsi_barang');
            $table->timestamps();

            $table->foreign('id_kategori')->references('id')->on('m_kategori_barangs')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barangs');
    }
};
