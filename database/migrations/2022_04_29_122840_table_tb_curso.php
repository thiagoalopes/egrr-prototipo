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
        Schema::create('tb_curso', function (Blueprint $table) {
            $table->id();
            $table->string('imagem', 1000)->nullable();
            $table->string('nome', 128)->unique();
            $table->text('descricao');
            $table->integer('carga_horaria');
            $table->unsignedBigInteger('id_tutor');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->integer('total_vagas');
            $table->unsignedBigInteger('id_situacao_curso');
            $table->timestamps();

            $table->foreign('id_tutor')->references('id')->on('tb_tutor');
            $table->foreign('id_situacao_curso')->references('id')->on('tb_situacao_curso');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_curso');
    }
};
