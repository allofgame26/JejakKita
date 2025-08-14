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
        Schema::create('t_pengisian_donasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('donasi_type', ['program', 'spesifik'])->comment('Jenis donasi: program atau spesifik');
            $table->unsignedBigInteger('donasi_id')->comment('ID dari program pembangunan atau donasi spesifik');
            $table->unsignedBigInteger('pembayaran_id');
            $table->decimal('jumlah_donasi', 15, 2);
            $table->text('pesan_donatur')->nullable();
            $table->datetime('tanggal_donasi')->default(now());
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('pembayaran_id')->references('id')->on('m_metode_pembayarans')->cascadeOnDelete()->cascadeOnUpdate();
            
            // Index untuk performa
            $table->index(['donasi_type', 'donasi_id']);
            $table->index('tanggal_donasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pengisian_donasis');
    }
};
