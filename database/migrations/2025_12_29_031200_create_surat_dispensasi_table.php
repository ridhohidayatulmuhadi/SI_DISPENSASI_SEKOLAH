<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_dispensasi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat', 50)->nullable();

            $table->foreignId('siswa_id')
                  ->nullable()
                  ->constrained('siswa')
                  ->nullOnDelete();

            $table->foreignId('jenis_surat_id')
                  ->nullable()
                  ->constrained('jenis_surat')
                  ->nullOnDelete();

            $table->foreignId('admin_id')
                  ->nullable()
                  ->constrained('admin')
                  ->nullOnDelete();

            $table->text('alasan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_dispensasi');
    }
};
