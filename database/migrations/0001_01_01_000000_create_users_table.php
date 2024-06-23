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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('The primary key of the users table');
            $table->string('name')->comment('The name of the user');
            $table->string('email')->unique()->comment('The email of the user');
            // $table->timestamp('email_verified_at')->nullable()->comment('The time the email was verified');
            $table->string('password')->comment('The password of the user');
            $table->rememberToken()->comment('The token to remember the user');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary()->comment('The email of the user');
            $table->string('token')->comment('The token to reset the password');
            $table->timestamp('created_at')->nullable()->comment('The time the token was created');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary()->comment('The primary key of the sessions table');
            $table->foreignId('user_id')->nullable()->index()->comment('The user who owns the session');
            $table->string('ip_address', 45)->nullable()->comment('The IP address of the user');
            $table->text('user_agent')->nullable()->comment('The user agent of the user');
            $table->longText('payload')->comment('The payload of the session');
            $table->integer('last_activity')->index()->comment('The last activity of the user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
