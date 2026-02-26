<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qurban_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('kode_registrasi', 20)->unique();     // QRB-20250101-A3F9K2

            $table->foreignId('hewan_id')
                ->constrained('qurban_hewans')
                ->cascadeOnDelete();

            $table->foreignId('period_id')
                ->constrained('qurban_periods')
                ->cascadeOnDelete();

            // Data peserta (shohibul qurban yang bayar)
            $table->string('nama_peserta');
            $table->string('atas_nama')->nullable();              // atas nama siapa qurban ini
            $table->string('email')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->text('catatan')->nullable();

            // Slot & Harga
            // jumlah_slot: selalu 1 per registrasi (1 orang = 1 slot)
            // Untuk sapi: 1 slot dari 7 yang tersedia
            // Untuk kambing: 1 slot dari 1 (langsung penuh)
            $table->unsignedTinyInteger('jumlah_slot')->default(1);
            $table->unsignedBigInteger('harga_per_slot');
            $table->unsignedBigInteger('total_bayar');           // jumlah_slot × harga_per_slot

            // Status
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->foreignId('confirmed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Payment gateway ready
            $table->string('payment_gateway')->nullable();
            $table->string('gateway_transaction_id')->nullable();
            $table->string('gateway_status')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['hewan_id', 'status']);
            $table->index(['period_id', 'status']);
            $table->index('kode_registrasi');
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qurban_registrations');
    }
};
