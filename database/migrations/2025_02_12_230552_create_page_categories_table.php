<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('page_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->enum('page_type', ['project', 'cuisine', 'dressing'])->default('project'); // You can add more page types here.
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('page_categories');
    }
};
