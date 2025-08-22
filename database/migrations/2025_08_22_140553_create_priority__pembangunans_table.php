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
        Schema::create('priority_pembangunans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('priority_id');
            $table->float('nilai_priority');
            $table->timestamps();

            $table->foreign('pembangunan_id')->references('id')->on('m_program_pembangunans')->cascadeOnUpdate();
            $table->foreign('priority_id')->references('id')->on('priorities')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priority_pembangunans');
    }
};
