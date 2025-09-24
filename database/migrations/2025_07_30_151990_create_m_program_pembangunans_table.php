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
        Schema::create('m_program_pembangunans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mandor_id');
            $table->string('kode_program')->unique();
            $table->string('nama_pembangunan');
            $table->date('estimasi_tanggal_selesai');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai_aktual')->nullable();
            $table->string('estimasi_biaya');
            $table->enum('status',['diajukan','direncanakan','berjalan','selesai','ditunda']);
            $table->string('deskripsi');
            $table->timestamps();

            $table->foreign('mandor_id')->references('id')->on('m_mandors')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_program_pembangunans');
    }
};
