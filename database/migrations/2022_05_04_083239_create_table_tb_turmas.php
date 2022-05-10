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
        Schema::create('tb_turmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_situacao_turma')->default(2); // 2-Turma Fechada
            $table->text('descricao_turma');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->time('horario_inicio_aula');
            $table->time('horario_termino_aula');
            $table->integer('total_vagas_turma');
            $table->timestamps();

            $table->foreign('id_curso')->references('id')->on('tb_curso');
            $table->foreign('id_situacao_turma')->references('id')->on('tb_situacao_turma');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_turmas');
    }
};
