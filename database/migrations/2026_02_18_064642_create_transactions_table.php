<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 20)->unique();
            $table->enum('type', ['zakat', 'infaq', 'donasi', 'fidyah']);
            $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete();

            // Data muzakki / donatur
            $table->string('nama_donatur');
            $table->string('email')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->boolean('is_anonim')->default(false);

            // Nominal
            $table->unsignedBigInteger('jumlah');

            // Detail spesifik (JSON)
            // Zakat Mal  : { jenis:"mal", nilai_harta:50000000, nisab_gram:85 }
            // Zakat Fitrah: { jenis:"fitrah", jumlah_jiwa:4, harga_per_jiwa:37500 }
            // Fidyah     : { jumlah_hari:30, harga_per_hari:50000 }
            // Infaq/Donasi: {} (via program_id)
            $table->json('metadata')->nullable();

            $table->text('catatan')->nullable();

            // Status alur pembayaran manual
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');

            // Admin action
            $table->timestamp('confirmed_at')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('catatan_admin')->nullable();

            // Payment gateway ready (akan diisi saat integrasi gateway)
            $table->string('payment_gateway')->nullable()->comment('midtrans|xendit|dll');
            $table->string('gateway_transaction_id')->nullable();
            $table->string('gateway_status')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['type', 'status']);
            $table->index('kode_transaksi');
            $table->index('email');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
