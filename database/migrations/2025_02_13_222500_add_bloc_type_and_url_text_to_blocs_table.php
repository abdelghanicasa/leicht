<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('blocs', function (Blueprint $table) {
            $table->string('bloc_type')->after('id')->index(); // Unique identifier for each bloc
            $table->string('url_text')->nullable()->after('url'); // Button text for URL
        });
    }

    public function down()
    {
        Schema::table('blocs', function (Blueprint $table) {
            $table->dropColumn(['bloc_type', 'url_text']);
        });
    }
};

