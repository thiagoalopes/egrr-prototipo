<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConteudosCursos extends Model
{
    use HasFactory;

    protected $table = 'tb_conteudos_cursos';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'id_curso',
        'sequencial_ordenacao',
        'conteudo',
        'created_at',
        'update_at',
    ];
}
