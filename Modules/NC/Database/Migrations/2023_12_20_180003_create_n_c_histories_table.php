<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('n_c_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('non_conformity_id');
            $table->foreign('non_conformity_id')
                ->references('id')
                ->on('non_conformities')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('changed_field');
            $table->longText('old_value')->nullable();
            $table->longText('new_value');

            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('n_c_histories');
    }
};
