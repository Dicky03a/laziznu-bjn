<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('tahun_berdiri')->nullable();
            $table->bigInteger('penerima_manfaat')->default(0);
            $table->integer('program_tersalurkan')->default(0);
            $table->text('visi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
