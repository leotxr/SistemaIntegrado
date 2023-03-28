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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitante_id');
            $table->foreign('solicitante_id')->references('id')->on('users');
            $table->unsignedBigInteger('atendente_id')->nullable();
            $table->foreign('atendente_id')->references('id')->on('users');
            /*
            $table->unsignedBigInteger('setor_id');
            $table->foreign('setor_id')->references('id')->on('sectors');
*/
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->string('assunto')->nullable();
            $table->longText('descricao_abertura')->nullable();
            $table->longText('descricao_fechamento')->nullable();
            $table->dateTime('hora_abertura')->nullable();
            $table->time('tempo_corrido')->nullable();
            $table->dateTime('inicio_atendimento')->nullable();
            $table->dateTime('fim_atendimento')->nullable();
            $table->time('tempo_atendimento')->nullable();

            $table->boolean('pausado')->default(0);
            $table->dateTime('inicio_pausa')->nullable();
            $table->dateTime('fim_pausa')->nullable();
            $table->time('tempo_pausa')->nullable();

            $table->time('tempo_total')->nullable();

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
        Schema::dropIfExists('tickets');
    }
};
