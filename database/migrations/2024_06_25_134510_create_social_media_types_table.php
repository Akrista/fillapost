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
        Schema::create('social_media_types', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['linkedin', 'wakatime', 'steam', 'openai'])->unique()->comment('The type of the social media service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media_services');
    }
};
