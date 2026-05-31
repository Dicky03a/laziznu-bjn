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
        Schema::table('news', function (Blueprint $table) {
            $table->index('published_at');
        });

        Schema::table('programs', function (Blueprint $table) {
            $table->index('is_featured');
            $table->index('is_active');
        });

        Schema::table('distribution_programs', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->index('status');
            $table->index('type');
        });

        Schema::table('mustahiks', function (Blueprint $table) {
            $table->index('status');
            $table->index('kategori_asnaf');
        });

        Schema::table('pengurus', function (Blueprint $table) {
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex(['published_at']);
        });

        Schema::table('programs', function (Blueprint $table) {
            $table->dropIndex(['is_featured']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('distribution_programs', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['type']);
        });

        Schema::table('mustahiks', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['kategori_asnaf']);
        });

        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });
    }
};
