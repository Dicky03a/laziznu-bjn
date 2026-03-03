<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qurban_periods', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                              
            $table->smallInteger('tahun');                      
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(false);        
            $table->date('tanggal_buka')->nullable();           
            $table->date('tanggal_tutup')->nullable();         
            $table->date('tanggal_pelaksanaan')->nullable();    
            $table->timestamps();

            $table->index('is_active');
            $table->index('tahun');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qurban_periods');
    }
};
