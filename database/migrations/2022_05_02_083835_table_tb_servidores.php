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
            $table->text('foto')->nullable();
            $table->string('nome', 128);
            $table->string('cpf', 16)->unique();
            $table->enum('tipo_vinculo', ['efetivo', 'comissionado','efetcomis','temporario','federal']);
            $table->string('matricula', 16)->unique();
            $table->enum('sexo',['f','m','o','n']);
            $table->string('cargo', 128);
            $table->string('funcao', 128);
            $table->unsignedInteger('id_secretaria_servidores')->nullable();
            $table->boolean('servidor_confirmado')->default('false');
            $table->string('email', 64);
            $table->string('celular',16);
            $table->string('telefone',16)->nullable();
            $table->string('senha', 512);
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
