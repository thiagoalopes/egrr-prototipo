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
        Schema::create('tb_certificados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_servidor');
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_inscricao');
            $table->unsignedBigInteger('id_assinatura_gestor');
            $table->string('nome_servidor');
            $table->string('cpf');
            $table->string('matricula');
            $table->string('tipo_vinculo');
            $table->string('curso');
            $table->string('professor');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->string('carga_horaria');
            $table->string('aproveitamento');
            $table->string('diretor_egrr');
            $table->string('assinatura_diretor_egrr');
            $table->string('secretario_segad');
            $table->json('conteudos');
            $table->string('assinatura_secretario_segad');
            $table->string('data_emissao');
            $table->string('id_servidor_emitente');

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
        Schema::dropIfExists('tb_certificados');
    }
};
