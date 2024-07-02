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
            $table->unsignedBigInteger('social_media_type_id')->comment('The type of the social media service');
            $table->foreign('social_media_type_id')->references('id')->on('social_media_types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->comment('The name of the social media service');
            $table->string('client_id')->nullable()->comment('The client id of the social media service');
            $table->string('client_secret')->nullable()->comment('The client secret of the social media service');
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
