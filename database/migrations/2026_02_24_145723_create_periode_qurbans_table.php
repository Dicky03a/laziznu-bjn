<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periode_qurbans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                            // "Qurban 1446 H"
            $table->string('tahun_hijriah', 10);
            $table->year('tahun_masehi');
            $table->date('tgl_buka_pendaftaran');
            $table->date('tgl_tutup_pembayaran');
            $table->date('tgl_pelaksanaan');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['draft', 'aktif', 'ditutup', 'selesai'])->default('draft');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periode_qurbans');
    }
};
