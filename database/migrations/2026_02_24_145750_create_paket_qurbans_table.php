<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_qurbans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periode_qurbans')->cascadeOnDelete();
            $table->string('nama_paket');                           // "Sapi Patungan 7 Orang"
            $table->enum('jenis_hewan', ['sapi', 'unta', 'kambing', 'domba']);
            $table->unsignedTinyInteger('max_peserta');             // 7 untuk sapi/unta, 1 untuk kambing/domba
            $table->decimal('harga_estimasi', 15, 2);               // harga estimasi per ekor
            $table->decimal('iuran_per_peserta', 15, 2);            // harga_estimasi / max_peserta
            $table->string('estimasi_bobot')->nullable();            // "250–300 kg"
            $table->text('deskripsi')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_qurbans');
    }
};
