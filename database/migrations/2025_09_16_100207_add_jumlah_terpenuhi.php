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
        Schema::table('t_kebutuhan_barang_programs', function (Blueprint $table) {
            $table->integer('jumlah_terpenuhi')->default(0)->after('jumlah_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_kebutuhan_barang_programs', function (Blueprint $table) {
            //
        });
    }
};
