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
        Schema::create('extra_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('sector')->nullable();
            $table->unsignedBigInteger('requester_id');
            $table->foreign('requester_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_ticket')->default(false);
            $table->string('item')->nullable();
            $table->string('action')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('ticket_statuses')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('extra_services');
    }
};
