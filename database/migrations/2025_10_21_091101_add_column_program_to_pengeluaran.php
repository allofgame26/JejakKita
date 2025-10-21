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
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->foreignId('program_id')
                  ->nullable()
                  ->after('sumber_id') // Opsional: menempatkan kolom ini setelah kolom 'id'
                  ->constrained('m_program_pembangunans') // Merujuk ke tabel 'm_program_pembangunan'
                  ->onDelete('cascade'); // Jika program dihapus, set kolom ini menjadi null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->dropForeign(['kebutuhan_barang_id']);

            // BARU hapus kolomnya
            $table->dropColumn('kebutuhan_barang_id');
        });
    }
};
