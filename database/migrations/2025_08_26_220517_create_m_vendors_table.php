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
        Schema::create('m_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('kode_vendor');
            $table->string('nama_vendor');
            $table->string('alamat_vendor');
            $table->string('no_telepon');
            $table->string('keterangan')->nullable();
            $table->enum('status',['aktif','tidak aktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_vendors');
    }
};
