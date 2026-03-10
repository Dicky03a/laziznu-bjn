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
        Schema::table('kecamatans', function (Blueprint $table) {
            // Kolom untuk menyimpan koordinat peta. Opsional untuk kecamatan yang belum memiliki data.
            if (!Schema::hasColumn('kecamatans', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->change();
            }
            if (!Schema::hasColumn('kecamatans', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kecamatans', function (Blueprint $table) {
            $table->dropColumn(['jumlah_muzakki', 'jumlah_mustahik']);
        });
    }
};
