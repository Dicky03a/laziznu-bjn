<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qurban_periods', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                              // "Qurban Idul Adha 1446 H / 2025 M"
            $table->smallInteger('tahun');                       // 2025
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(false);        // hanya 1 aktif sekaligus
            $table->date('tanggal_buka')->nullable();            // pendaftaran dibuka
            $table->date('tanggal_tutup')->nullable();           // deadline daftar
            $table->date('tanggal_pelaksanaan')->nullable();     // hari penyembelihan
            $table->timestamps();

            $table->index('is_active');
            $table->index('tahun');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qurban_periods');
    }
};
