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
            $table->unsignedBigInteger('initial_status_id')->default(1);
            $table->foreign('initial_status_id')
            ->references('id')
            ->on('budget_statuses')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unsignedBigInteger('budget_status_id')->default(1);
            $table->foreign('budget_status_id')
            ->references('id')
            ->on('budget_statuses')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unsignedBigInteger('last_user_id');
            $table->foreign('last_user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unsignedBigInteger('budget_type_id');
            $table->foreign('budget_type_id')
            ->references('id')
            ->on('budget_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->text('observation')->nullable();
            $table->date('budget_date');
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
