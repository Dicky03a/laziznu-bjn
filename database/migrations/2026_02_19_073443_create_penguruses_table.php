<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('gelar_depan', 50)->nullable();
            $table->string('gelar_belakang', 100)->nullable();
            $table->enum('jabatan', [
                'Ketua',
                'Wakil Ketua',
                'Sekretaris',
                'Wakil Sekretaris',
                'Anggota',
            ]);
            $table->string('bidang', 100)->nullable()->comment('Diisi jika jabatan = Anggota');
            $table->unsignedTinyInteger('urutan')->default(0)->comment('Urutan tampil');
            $table->string('foto', 255)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->year('masa_khidmat_mulai');
            $table->year('masa_khidmat_selesai');
            $table->string('no_sk', 100)->nullable()->comment('Nomor SK pengangkatan');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['masa_khidmat_mulai', 'masa_khidmat_selesai']);
            $table->index(['jabatan', 'is_active']);
            $table->index('urutan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};
