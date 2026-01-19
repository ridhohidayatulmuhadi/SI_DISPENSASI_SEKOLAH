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
        Schema::table('surat_dispensasi', function (Blueprint $table) {
            $table->time('waktu_kembali_batas')->nullable()->after('kembali_pelajaran_ke');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_dispensasi', function (Blueprint $table) {
            //
        });
    }
};
