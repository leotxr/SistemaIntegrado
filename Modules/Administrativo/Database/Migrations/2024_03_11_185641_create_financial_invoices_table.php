<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->string('patient_name')->nullable();
            $table->integer('exam_id')->nullable();
            $table->string('exam_description')->nullable();
            $table->date('exam_date')->nullable();
            $table->string('insurance')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->string('doctor')->nullable();
            $table->float('paid_insurance')->nullable();
            $table->float('paid_patient')->nullable();
            $table->float('total_value')->nullable();
            $table->boolean('payment_enable');
            $table->boolean('processed')->default(false);
            $table->unsignedBigInteger('requester_id');
            $table->foreign('requester_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('financial_invoices');
    }
};
