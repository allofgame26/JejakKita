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
            $table->foreignId('kebutuhan_id')->nullable()->constrained('t_kebutuhan_barang_programs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_transaksi_barangs', function (Blueprint $table) {
            //
        });
    }
};
