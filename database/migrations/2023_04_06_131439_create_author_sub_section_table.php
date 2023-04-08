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
        Schema::create('author_sub_section', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('authors')->cascadeOnDelete();
            $table->foreignId('sub_section_id')->constrained('sub_sections')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_sub_section');
    }
};