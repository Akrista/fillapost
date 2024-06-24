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
        Schema::create('social_media_services', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['linkedin'])->comment('The type of the social media service');
            $table->string('token')->comment('The token of the social media service');
            $table->unsignedBigInteger('user_id')->comment('The user who created the social media service');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
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
