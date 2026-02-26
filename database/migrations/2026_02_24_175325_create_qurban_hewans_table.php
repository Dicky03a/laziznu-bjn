<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qurban_hewans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')
                ->constrained('qurban_periods')
                ->cascadeOnDelete();

            // Jenis hewan — menentukan aturan syar'i
            $table->enum('jenis', ['sapi', 'unta', 'kambing', 'domba']);

            $table->string('nama');                              // "Sapi Jawa Premium A"
            $table->text('deskripsi')->nullable();
            $table->string('berat_estimasi', 50)->nullable();    // "250–300 kg"
            $table->string('gambar')->nullable();

            // Harga
            $table->unsignedBigInteger('harga_total');           // harga 1 ekor penuh
            $table->unsignedBigInteger('harga_per_slot');        // harga_total / max_peserta

            // Slot — diatur otomatis berdasarkan jenis
            // sapi/unta = 7, kambing/domba = 1
            $table->unsignedTinyInteger('max_peserta');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['period_id', 'jenis', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qurban_hewan');
    }
};
