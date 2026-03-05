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
        Schema::create('mustahiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 20)->unique();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->foreignId('kecamatan_id')->constrained()->onDelete('cascade');
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('no_hp', 15);
            $table->enum('kategori_asnaf', ['fakir', 'miskin', 'amil', 'muallaf', 'riqab', 'gharim', 'fisabilillah', 'ibnu_sabil']);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mustahiks');
    }
};
