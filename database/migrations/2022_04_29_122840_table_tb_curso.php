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
            $table->string('imagem', 1024)->nullable();
            $table->string('nome', 128)->unique();
            $table->string('descricao', 512);
            $table->integer('carga_horaria');
            $table->unsignedBigInteger('id_professor');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->integer('total_vagas');
            $table->string('endereco_curso', 512);
            $table->timestamps();

            $table->foreign('id_professor')->references('id')->on('tb_professor');

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
