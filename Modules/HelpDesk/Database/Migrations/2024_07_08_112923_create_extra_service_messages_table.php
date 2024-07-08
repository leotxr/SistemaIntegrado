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
        Schema::create('extra_service_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('message')->nullable();
            $table->boolean('read');
            $table->unsignedBigInteger('extra_service_id');
            $table->foreign('extra_service_id')
                ->references('id')
                ->on('extra_services')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('is_final_action')->default(false);


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
        Schema::dropIfExists('extra_service_messages');
    }
};
