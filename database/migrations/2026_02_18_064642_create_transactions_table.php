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

            $table->string('nama_donatur');
            $table->string('email')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->boolean('is_anonim')->default(false);

            $table->unsignedBigInteger('jumlah');

            $table->json('metadata')->nullable();

            $table->text('catatan')->nullable();

            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');

            $table->timestamp('confirmed_at')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('catatan_admin')->nullable();

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
