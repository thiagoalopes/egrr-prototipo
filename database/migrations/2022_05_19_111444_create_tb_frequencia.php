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
        Schema::create('tb_frequencia', function (Blueprint $table) {
            $table->id();
            $table->boolean('ispresente')->default(false);
            $table->unsignedBigInteger('id_servidor');
            $table->string('nome_servidor');
            $table->unsignedBigInteger('id_secretaria_servidor');
            $table->string('sigla_secretaria');
            $table->unsignedBigInteger('id_turma');
            $table->string('descricao_turma');
            $table->unsignedBigInteger('id_curso');
            $table->string('nome_curso');
            $table->unsignedBigInteger('id_professor');
            $table->string('nome_professor');
            $table->string('data_aula');

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
        Schema::dropIfExists('tb_frequencia');
    }
};
