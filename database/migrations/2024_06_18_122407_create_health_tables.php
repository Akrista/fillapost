<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Health\Models\HealthCheckResultHistoryItem;
use Spatie\Health\ResultStores\EloquentHealthResultStore;

return new class extends Migration
{
    public function up()
    {
        $connection = (new HealthCheckResultHistoryItem())->getConnectionName();
        $tableName = EloquentHealthResultStore::getHistoryItemInstance()->getTable();

        Schema::connection($connection)->create($tableName, function (Blueprint $table) {
            $table->id()->comment('The primary key of the table');
            $table->string('check_name')->comment('The name of the check');
            $table->string('check_label')->comment('The label of the check');
            $table->string('status')->comment('The status of the check');
            $table->text('notification_message')->nullable()->comment('The notification message of the check');
            $table->string('short_summary')->nullable()->comment('The short summary of the check');
            $table->json('meta')->comment('The meta data of the check');
            $table->timestamp('ended_at')->comment('The ended at timestamp of the check');
            $table->uuid('batch')->comment('The batch of the check');
            $table->timestamps();
        });

        Schema::connection($connection)->table($tableName, function (Blueprint $table) {
            $table->index('created_at');
            $table->index('batch');
        });
    }
};
