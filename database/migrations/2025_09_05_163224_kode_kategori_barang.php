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
        Schema::table('m_kategori_barangs', function (Blueprint $table) {
        // Kolom untuk menyimpan kode seperti "CLC-1"
        $table->string('kode_kategori')->unique()->nullable()->after('id');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
