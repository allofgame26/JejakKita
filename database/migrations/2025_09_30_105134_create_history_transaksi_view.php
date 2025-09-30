<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR REPLACE VIEW history_transaksi AS SELECT
                            tdp.id,
                            tdp.user_id,
                            tdp.pembayaran_id,
                            'Program' AS jenis_transaksi,
                            pp.nama_pembangunan AS deskripsi,
                            tdp.jumlah_donasi,
                            tdp.status_pembayaran,
                            tdp.created_at,
                            tdp.updated_at
                        FROM
                            t_transaksi_donasi_programs AS tdp
                        JOIN
                            m_program_pembangunans AS pp ON tdp.program_id = pp.id
                        UNION ALL 
                            SELECT
                            tds.id,
                            tds.user_id,
                            tds.pembayaran_id,
                            'Spesifik' AS jenis_transaksi,
                            mb.nama_barang AS deskripsi,
                            tds.jumlah_donasi,
                            tds.status_pembayaran,
                            tds.created_at,
                            tds.updated_at
                        FROM
                            t_transaksi_donasi_spesifiks AS tds
                        JOIN
                            donasi_kebutuhans AS dk ON tds.id = dk.donasi_id
                        JOIN
                            t_kebutuhan_barang_programs AS tkbp ON dk.kebutuhan_id = tkbp.id
                        JOIN
                            m_barangs AS mb ON tkbp.barang_id = mb.id");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS history_transaksi");
    }
};
