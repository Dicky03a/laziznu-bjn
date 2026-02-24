<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->constrained('peserta_qurbans')->cascadeOnDelete();
            $table->string('kode_bayar', 30)->unique();              // PAY-2025-XXXXXX
            $table->decimal('jumlah', 15, 2);
            $table->enum('metode', ['transfer', 'tunai', 'qris', 'lainnya'])->default('transfer');
            $table->string('bank_tujuan')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('atas_nama')->nullable();
            $table->date('tgl_bayar');
            $table->string('bukti_bayar')->nullable();               // path file
            $table->enum('status', ['pending', 'diverifikasi', 'ditolak'])->default('pending');
            $table->text('catatan_verifikator')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('tgl_verifikasi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
