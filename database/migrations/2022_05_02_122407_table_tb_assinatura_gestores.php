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
            $table->unsignedBigInteger('id_tipos_gestores');
            $table->string('nome_gestor', 128)->unique();
            $table->string('imagem_assinatura_gestor', 1000);
            $table->date('inicio_vigencia');
            $table->date('termino_vigencia')->nullable();
            $table->timestamps();

            $table->foreign('id_tipos_gestores')->references('id')->on('tb_tipos_gestores');

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
