<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['infaq', 'donasi']);
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->longText('konten')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedBigInteger('target_dana')->nullable()->comment('null = tidak ada target');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable()->comment('null = program berkelanjutan');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['type', 'is_active']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
