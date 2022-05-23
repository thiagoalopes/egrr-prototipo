<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
    use HasFactory;

    protected $table = 'tb_frequencia';
    public $timestamps = true;

    protected $fillable = [
        'ispresente',
        'id_inscricao',
        'id_servidor',
        'id_secretaria_servidor',
        'id_curso',
        'id_turma',
        'id_professor',
        'nome_servidor',
        'sigla_secretaria',
        'nome_curso',
        'descricao_turma',
        'nome_professor',
        'data_aula',
        'created_at',
        'updated_at'
    ];

}
