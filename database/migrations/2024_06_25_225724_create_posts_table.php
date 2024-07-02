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
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->comment('The primary key of the posts table');
            $table->string('title')->nullable()->comment('The title of the post');
            $table->text('content')->comment('The content of the post');
            $table->enum('status', ['draft', 'scheduled', 'published', 'failed'])->default('draft')->comment('The status of the post');
            $table->boolean('draft')->default(true)->comment('The post is a draft');
            $table->string('internal_id')->nullable()->comment('The internal ID of the post');
            $table->timestamp('scheduled_at')->nullable()->comment('The time the post is scheduled');
            $table->date('published_at')->nullable()->comment('The time the post was published');
            $table->unsignedBigInteger('user_id')->comment('The user who created the post');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('service_account_id')->comment('The service account that published the post');
            $table->foreign('service_account_id')->references('id')->on('service_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
