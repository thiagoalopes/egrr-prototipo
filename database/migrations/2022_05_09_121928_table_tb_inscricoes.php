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
            $table->unsignedBigInteger('id_servidor');
            $table->unsignedInteger('id_turma');
            $table->boolean('inscricao_aprovada')->default('false');

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
        Schema::dropIfExists('tb_inscricoes');
    }
};