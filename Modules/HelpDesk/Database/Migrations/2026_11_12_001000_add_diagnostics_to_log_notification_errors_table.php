<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('log_notification_errors', function (Blueprint $table) {
            $table->string('failure_stage')->default('unknown')->after('job_name');
            $table->string('channel')->nullable()->after('failure_stage');
            $table->string('notification_type')->nullable()->after('channel');
            $table->string('notifiable_type')->nullable()->after('notification_type');
            $table->string('notifiable_id')->nullable()->after('notifiable_type');
            $table->string('exception_type')->nullable()->after('notifiable_id');
            $table->text('exception_file')->nullable()->after('exception_message');
            $table->unsignedInteger('exception_line')->nullable()->after('exception_file');
        });
    }

    public function down(): void
    {
        Schema::table('log_notification_errors', function (Blueprint $table) {
            $table->dropColumn([
                'failure_stage',
                'channel',
                'notification_type',
                'notifiable_type',
                'notifiable_id',
                'exception_type',
                'exception_file',
                'exception_line',
            ]);
        });
    }
};
