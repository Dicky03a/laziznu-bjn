<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->cascadeOnDelete();
            $table->string('nama_pengirim');
            $table->string('bank_pengirim');
            $table->string('nomor_rekening_pengirim', 30)->nullable();
            $table->unsignedBigInteger('jumlah_transfer');
            $table->date('tanggal_transfer');
            $table->string('bukti_transfer')->nullable()->comment('path file bukti pembayaran');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index('transaction_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_confirmations');
    }
};
