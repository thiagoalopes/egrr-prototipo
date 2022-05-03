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
        Schema::create('tb_servidores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 128);
            $table->string('cpf', 11)->unique();
            $table->enum('tipo_vinculo', ['efetivo', 'comissionado','temporario','outro']);
            $table->string('matricula', 32)->unique();
            $table->enum('sexo',['f','m','o']);
            $table->string('cargo', 128);
            $table->unsignedInteger('id_secretaria_servidores')->nullable();
            $table->string('email', 64);
            $table->string('celular');
            $table->string('telefone')->nullable();
            $table->timestamps();

            $table->foreign('id_secretaria_servidores')->references('id')->on('tb_secretaria_servidores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_servidores');
    }
};
