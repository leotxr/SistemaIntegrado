<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('non_conformities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('description');

            $table->unsignedBigInteger('source_user_id');
            $table->foreign('source_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('n_c_status_id');
            $table->foreign('n_c_status_id')
                ->references('id')
                ->on('n_c_statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('n_c_classification_id');
            $table->foreign('n_c_classification_id')
                ->references('id')
                ->on('n_c_classifications')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            /*
            $table->unsignedBigInteger('n_c_sector_id');
            $table->foreign('n_c_sector_id')
                ->references('id')
                ->on('user_groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');
*/
            $table->date('n_c_date');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_conformities');
    }
};
