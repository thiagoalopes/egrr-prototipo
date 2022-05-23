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
            $table->unsignedBigInteger('id_inscricao');
            $table->unsignedBigInteger('id_servidor');
            $table->unsignedBigInteger('id_secretaria_servidor');
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_turma');
            $table->unsignedBigInteger('id_professor');
            $table->string('nome_servidor');
            $table->string('sigla_secretaria');
            $table->string('nome_curso');
            $table->string('descricao_turma');
            $table->string('nome_professor');
            $table->date('data_aula');
            $table->timestamps();

            $table->unique(["id_turma", "data_aula", "id_servidor", "id_inscricao"]);
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
