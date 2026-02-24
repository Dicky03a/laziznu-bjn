<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peserta_qurbans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_hewan_id')->constrained('unit_hewans')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('kode_tracking', 20)->unique();           // QRB-2025-XXXXXX (untuk tracking publik)
            $table->string('nama_shohibul_qurban');                  // nama yang diniatkan
            $table->string('no_hp', 20);
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();
            $table->unsignedTinyInteger('no_urut_dalam_unit');       // 1–7 dalam satu sapi
            $table->decimal('total_tagihan', 15, 2);
            $table->decimal('total_dibayar', 15, 2)->default(0);
            $table->enum('status_bayar', ['belum', 'sebagian', 'lunas'])->default('belum');
            $table->enum('status_peserta', [
                'terdaftar',
                'aktif',
                'selesai',
                'dibatalkan'
            ])->default('terdaftar');
            $table->date('tgl_daftar');
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta_qurbans');
    }
};
