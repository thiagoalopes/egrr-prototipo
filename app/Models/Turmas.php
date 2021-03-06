<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turmas extends Model
{
    use HasFactory;

    protected $table = 'tb_turmas';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'id_curso',
        'id_situacao_turma',
        'descricao_turma',
        'data_inicio',
        'data_termino',
        'horario_inicio_aula',
        'horario_termino_aula',
        'total_vagas_turma',
        'created_at',
        'updated_at',
    ];

    public function situacao()
    {
        return $this->hasOne('App\Models\SituacaoTurmas','id', 'id_situacao_turma');
    }

    public function curso()
    {
        return $this->hasOne('App\Models\Cursos','id', 'id_curso');
    }
}
