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
        Schema::create('budget_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('budget_id');
            $table->foreign('budget_id')
                ->references('id')
                ->on('budgets')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('budget_plan_id');
            $table->foreign('budget_plan_id')
                ->references('id')
                ->on('budget_plans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->float('discount')->nullable();
            $table->float('value')->nullable();
            $table->float('final_value')->nullable();
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
        Schema::dropIfExists('budget_exams');
    }
};
