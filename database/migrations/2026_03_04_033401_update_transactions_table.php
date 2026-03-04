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
        Schema::table('transactions', function (Blueprint $table) {
            // Drop alamat column jika ada
            if (Schema::hasColumn('transactions', 'alamat')) {
                $table->dropColumn('alamat');
            }

            // Add kecamatan dan desa
            $table->foreignId('kecamatan_id')
                ->nullable()
                ->constrained('kecamatans')
                ->onDelete('set null');

            $table->foreignId('desa_id')
                ->nullable()
                ->constrained('desas')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kecamatan_id');
            $table->dropConstrainedForeignId('desa_id');

            // Add back alamat
            $table->string('alamat')->nullable();
        });
    }
};
