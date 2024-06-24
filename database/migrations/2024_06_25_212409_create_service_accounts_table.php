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
        Schema::create('service_accounts', function (Blueprint $table) {
            $table->id()->comment('The primary key of the service accounts table');
            $table->unsignedBigInteger('social_media_service_id')->comment('The social media service that the account belongs to');
            $table->foreign('social_media_service_id')->references('id')->on('social_media_services')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->comment('The name of the service account');
            $table->string('avatar')->nullable()->comment('The avatar of the service account');
            $table->string('internal_id')->comment('The internal ID of the service account');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_accounts');
    }
};
