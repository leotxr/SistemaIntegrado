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
        Schema::create('ticket_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('order')->nullable();
            $table->unsignedBigInteger('ticket_category_id');
            $table->foreign('ticket_category_id')
            ->references('id')
            ->on('ticket_categories')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('priority_id');
            $table->foreign('priority_id')
            ->references('id')
            ->on('ticket_priorities');
            

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
        Schema::dropIfExists('ticket_sub_categories');
    }
};
