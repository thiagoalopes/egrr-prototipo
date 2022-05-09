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
        Schema::create('tb_conteudos_cursos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_curso');
            $table->string('sequencial_ordenacao', 2);
            $table->string('conteudo', 512);
            $table->timestamps();

            $table->foreign('id_curso')->references('id')->on('tb_curso');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_conteudos_cursos');
    }
};
