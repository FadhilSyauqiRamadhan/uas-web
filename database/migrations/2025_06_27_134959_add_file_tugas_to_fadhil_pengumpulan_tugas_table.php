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
        Schema::table('fadhil_pengumpulan_tugas', function (Blueprint $table) {
        $table->string('file_tugas')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('fadhil_pengumpulan_tugas', function (Blueprint $table) {
        $table->dropColumn('file_tugas');
    });
    }
};
