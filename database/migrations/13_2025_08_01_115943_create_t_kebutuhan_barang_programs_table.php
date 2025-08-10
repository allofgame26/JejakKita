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
        Schema::create('t_kebutuhan_barang_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('barang_id');
            $table->string('jumlah_barang');
            $table->enum('status',['diambil','tersedia']);
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('m_program_pembangunans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('barang_id')->references('id')->on('m_barangs')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kebutuhan_barang_programs');
    }
};
