<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lampiran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('surat_dispensasi_id')
                  ->constrained('surat_dispensasi')
                  ->cascadeOnDelete();

            $table->string('nama_file', 150);
            $table->string('path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lampiran');
    }
};
