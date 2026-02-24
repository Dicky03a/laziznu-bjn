<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('distribusi_dagings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_hewan_id')->constrained('unit_hewans')->cascadeOnDelete();
            $table->foreignId('peserta_id')->nullable()->constrained('peserta_qurbans')->nullOnDelete();
            $table->string('nama_penerima');
            $table->string('no_hp_penerima')->nullable();
            $table->string('alamat_penerima')->nullable();
            $table->enum('tipe_penerima', ['peserta', 'hadiah', 'sedekah']);
            $table->decimal('berat_kg', 8, 2)->nullable();
            $table->date('tgl_distribusi')->nullable();
            $table->enum('status', ['disiapkan', 'diterima'])->default('disiapkan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distribusi_dagings');
    }
};
