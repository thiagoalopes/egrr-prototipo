<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricoes extends Model
{
    use HasFactory;

    protected $table = 'tb_inscricoes';

    protected $fillable = [
        'termo_aceito',
        'id_turma',
        'id_servidor',
        'codigo_inscricao',
        'situacao_inscricao',
        'data_situacao',
        'created_at',
        'updated_at'
    ];
}
