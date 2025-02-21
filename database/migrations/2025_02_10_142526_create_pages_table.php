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
        // Migration for pages
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title of the page
            $table->string('slug')->unique(); // Slug for URL
            $table->text('content'); // Page content (for text and HTML)
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
