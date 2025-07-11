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
        Schema::create('fadhil_mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode'); // Kode mata kuliah
            $table->string('nama_mata_kuliah');
            $table->string('dosen_pengampu');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fadhil_mata_kuliahs');
    }
};
