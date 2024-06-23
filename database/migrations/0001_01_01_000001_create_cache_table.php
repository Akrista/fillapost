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
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary()->comment('The primary key of the cache table');
            $table->mediumText('value')->comment('The value of the cache');
            $table->integer('expiration')->comment('The expiration time of the cache');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary()->comment('The primary key of the cache locks table');
            $table->string('owner')->nullable()->comment('The owner of the cache lock');
            $table->integer('expiration')->comment('The expiration time of the cache lock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
