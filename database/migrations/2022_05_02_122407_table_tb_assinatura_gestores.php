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
        Schema::create('tb_assinatura_gestores', function (Blueprint $table) {
            $table->id();
            $table->string('nome_secretario', 128);
            $table->string('nome_diretor_egrr', 128);
            $table->string('imagem_assinatura_secretario', 1000);
            $table->string('imagem_assinatura_diretor', 1000);

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
        Schema::dropIfExists('tb_assinatura_gestores');
    }
};
