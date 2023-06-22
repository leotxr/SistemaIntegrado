<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description')->nullable;
            $table->unsignedBigInteger('requester_id');
            $table->foreign('requester_id')
            ->references('id')
            ->on('users');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')->nullable();
            $table->datetime('ticket_open');
            $table->datetime('ticket_start')->nullable();
            $table->datetime('ticket_close')->nullable();
            $table->datetime('ticket_start_pause')->nullable();
            $table->datetime('ticket_end_pause')->nullable();
            $table->time('wait_time')->nullable();
            $table->time('total_pause')->nullable();
            $table->time('total_ticket')->nullable();


            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')
            ->references('id')
            ->on('ticket_statuses');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
            ->references('id')
            ->on('ticket_categories');

            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')
            ->references('id')
            ->on('ticket_sub_categories');






            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
