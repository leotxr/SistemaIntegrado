<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('serial_number')->nullable();
            $table->string('description')->nullable();
            $table->string('ip_address');
            $table->string('mac_address')->nullable();
            $table->string('link')->nullable();
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('device_type_id');
            $table->foreign('device_type_id')
            ->references('id')
            ->on('device_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->datetime('last_response')->nullable();
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
        Schema::dropIfExists('devices');
    }
};
