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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('exam_date')->nullable();
            $table->unsignedBigInteger('protocol_id');
            $table->foreign('protocol_id')->references('id')->on('protocols');
            $table->string('exam_status')->nullable();
            $table->unsignedBigInteger('exam_status_id');
            $table->foreign('exam_status_id')->references('id')->on('exam_statuses');
            $table->string('convenio');
            $table->string('exam_obs')->nullable();
            $table->string('exam_cod')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('exams');
    }
};
