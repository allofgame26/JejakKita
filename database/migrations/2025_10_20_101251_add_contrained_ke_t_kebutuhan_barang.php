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
        Schema::table('t_transaksi_barangs', function (Blueprint $table) {
            $table->foreignId('kebutuhan_barang_id')
                  ->nullable()
                  ->after('barang_id') // Opsional: menempatkan kolom ini setelah kolom 'id'
                  ->constrained('t_kebutuhan_barang_programs') // Merujuk ke tabel 't_kebutuhan_barang_programs'
                  ->onDelete('cascade'); // Jika kebutuhan barang dihapus, transaksi terkait juga dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_transaksi_barangs', function (Blueprint $table) {
            // Hapus foreign key constraint DULU
            $table->dropForeign(['kebutuhan_barang_id']);

            // BARU hapus kolomnya
            $table->dropColumn('kebutuhan_barang_id');
        });
    }
};
