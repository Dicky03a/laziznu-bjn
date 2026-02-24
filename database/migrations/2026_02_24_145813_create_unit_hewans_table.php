<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_hewans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket_qurbans')->cascadeOnDelete();
            $table->string('nomor_unit', 30)->unique();              // SAPI-001, KMB-003
            $table->unsignedTinyInteger('kuota');                    // copy dari max_peserta
            $table->unsignedTinyInteger('terisi')->default(0);       // jumlah peserta terdaftar
            $table->enum('status', [
                'open',
                'penuh',
                'terbeli',
                'disembelih',
                'selesai'
            ])->default('open');
            $table->string('nama_hewan')->nullable();                // nama/identitas hewan
            $table->string('foto_hewan')->nullable();
            $table->date('tgl_beli')->nullable();
            $table->decimal('harga_aktual', 15, 2)->nullable();
            $table->string('nama_penjual')->nullable();
            $table->string('lokasi_penyembelihan')->nullable();
            $table->date('tgl_sembelih')->nullable();
            $table->string('nama_juru_sembelih')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_hewans');
    }
};
