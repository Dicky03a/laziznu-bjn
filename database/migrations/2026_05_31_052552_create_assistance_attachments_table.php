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
        Schema::create('assistance_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assistance_request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assistance_requirement_id')->constrained()->cascadeOnDelete();
            $table->text('value'); // Stores the text answer or the file path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistance_attachments');
    }
};
