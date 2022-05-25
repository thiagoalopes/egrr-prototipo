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
        Schema::create('tb_inscricoes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_inscricao');
            $table->unsignedBigInteger('id_servidor');
            $table->string('nome_servidor');
            $table->string('cpf_servidor');
            $table->string('matricula');
            $table->string('secretaria');
            $table->string('sigla');
            $table->unsignedInteger('id_turma');
            $table->boolean('termo_aceito');
            $table->enum('situacao_inscricao',['pendente','confirmada','cancelada'])->default('pendente');
            $table->date('data_situacao');
            $table->text('observacoes')->nullable()->default(null);

            $table->timestamps();

            $table->foreign('id_servidor')->references('id')->on('tb_servidores');
            $table->foreign('id_turma')->references('id')->on('tb_turmas');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_inscricoes');
    }
};
