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
        Schema::create('t_transaksi_donasi_spesifiks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pembayaran_id');
            $table->string('jumlah_donasi');
            $table->enum('status_pembayaran',['gagal','pending','sukses']);
            $table->string('pesan_donatur');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('pembayaran_id')->references('id')->on('m_metode_pembayarans')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_transaksi_donasi_spesifiks');
    }
};
