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
        Schema::create('t_pengisian_donasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap_donatur');
            $table->unsignedBigInteger('pembayaran_id');
            $table->foreign('pembayaran_id')->references('id')->on('m_metode_pembayarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('jumlah_donasi', 15, 2);
            $table->text('pesan_donatur')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pengisian_donasi');
    }
};
