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
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
            $table->string('patient_name')->nullable();
            $table->integer('patient_age')->nullable();
            $table->string('procedure')->nullable();
            $table->datetime('start_hour')->nullable();
            $table->datetime('final_hour')->nullable();
            $table->date('exam_date')->nullable();
            $table->string('observation')->nullable();


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
        Schema::dropIfExists('terms');
    }
};
