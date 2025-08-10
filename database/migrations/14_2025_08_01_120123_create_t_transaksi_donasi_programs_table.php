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
        Schema::create('t_transaksi_donasi_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_program');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_metode_pembayaran');
            $table->string('jumlahdonasi');
            $table->enum('status_pembayaran',['gagal','pending','sukses']);
            $table->string('pesan_donatur');
            $table->timestamps();

            $table->foreign('id_program')->references('id')->on('m_program_pembangunans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_metode_pembayaran')->references('id')->on('m_metode_pembayarans')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_transaksi_donasi_programs');
    }
};
