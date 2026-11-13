<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_notification_errors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_id')->nullable();
            $table->string('connection')->nullable();
            $table->string('queue')->nullable();
            $table->string('job_name');
            $table->text('exception_message');
            $table->longText('exception_trace');
            $table->json('context')->nullable();
            $table->timestamp('failed_at')->useCurrent();

            $table->index('job_id');
            $table->index('failed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_notification_errors');
    }
};
