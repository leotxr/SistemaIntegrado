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
        Schema::create('budgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_name');
            $table->date('patient_born_date')->nullable();
            $table->string('patient_phone')->nullable();
            $table->float('discount')->nullable();
            $table->float('total_value')->nullable();
            $table->unsignedBigInteger('budget_status_id')->default(1);
            $table->foreign('budget_status_id')
            ->references('id')
            ->on('budget_statuses')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->text('observation')->nullable();
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
        Schema::dropIfExists('budgets');
    }
};
