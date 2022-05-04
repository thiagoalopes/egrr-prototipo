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
        Schema::create('tb_professor', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 128);
            $table->string('cpf', 64)->unique()->nullable();
            $table->enum('sexo',['f','m','o']);
            $table->string('celular', 20)->nullable();
            $table->string('email', 32)->nullable();
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
        Schema::dropIfExists('tb_professor');
    }
};
