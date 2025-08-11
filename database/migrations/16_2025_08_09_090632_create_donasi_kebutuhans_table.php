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
        Schema::create('donasi_kebutuhans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kebutuhan_id');
            $table->unsignedBigInteger('donasi_id');
            $table->timestamps();

            $table->foreign('kebutuhan_id')->references('id')->on('t_kebutuhan_barang_programs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('donasi_id')->references('id')->on('t_transaksi_donasi_spesifiks')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi_kebutuhans');
    }
};
