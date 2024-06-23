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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id()->comment('The primary key of the jobs table');
            $table->string('queue')->index()->comment('The queue of the job');
            $table->longText('payload')->comment('The payload of the job');
            $table->unsignedTinyInteger('attempts')->comment('The attempts of the job');
            $table->unsignedInteger('reserved_at')->nullable()->comment('The time the job was reserved');
            $table->unsignedInteger('available_at')->comment('The time the job is available');
            $table->unsignedInteger('created_at')->comment('The time the job was created');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary()->comment('The primary key of the job batches table');
            $table->string('name')->comment('The name of the job batch');
            $table->integer('total_jobs')->comment('The total jobs of the job batch');
            $table->integer('pending_jobs')->comment('The pending jobs of the job batch');
            $table->integer('failed_jobs')->comment('The failed jobs of the job batch');
            $table->longText('failed_job_ids')->comment('The failed job IDs of the job batch');
            $table->mediumText('options')->nullable()->comment('The options of the job batch');
            $table->integer('cancelled_at')->nullable()->comment('The time the job batch was cancelled');
            $table->integer('created_at')->comment('The time the job batch was created');
            $table->integer('finished_at')->nullable()->comment('The time the job batch was finished');
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id()->comment('The primary key of the failed jobs table');
            $table->string('uuid')->unique()->comment('The UUID of the failed job');
            $table->text('connection')->comment('The connection of the failed job');
            $table->text('queue')->comment('The queue of the failed job');
            $table->longText('payload')->comment('The payload of the failed job');
            $table->longText('exception')->comment('The exception of the failed job');
            $table->timestamp('failed_at')->useCurrent()->comment('The time the job failed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
