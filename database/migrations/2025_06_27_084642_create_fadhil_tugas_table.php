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
        Schema::create('fadhil_tugas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->date('deadline');
            $table->foreignId('mata_kuliah_id')->constrained('fadhil_mata_kuliahs')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('fadhil_kategoris')->onDelete('cascade');
            $table->foreignId('dibuat_oleh_user_id')->constrained('users')->onDelete('cascade'); // Ketua kelas
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fadhil_tugas');
    }
};
