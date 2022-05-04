<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    protected $table = 'tb_curso';
    public $timestamps = true;

    protected $fillable = [
        'decricao',
        'carga_horaria',
        'id_tutor',
        'data_inicio',
        'data_termino',
        'total_vagas',
        'id_situacao_curso',
        'created_at',
        'update_at',
    ];

    public function professor()
    {
        return $this->hasOne('App\Models\Professores', 'id', 'id_professor');
    }

    public function situacao()
    {
        return $this->hasOne('App\Models\SituacaesCursos', 'id', 'id_situacao_curso');
    }
}
