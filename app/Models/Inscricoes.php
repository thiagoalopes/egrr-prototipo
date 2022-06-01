<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricoes extends Model
{
    use HasFactory;

    protected $table = 'tb_inscricoes';
    public $timestamps = true;

    protected $fillable = [
        'termo_aceito',
        'id_turma',
        'nome_servidor',
        'cpf_servidor',
        'tipo_vinculo',
        'matricula',
        'secretaria',
        'sigla',
        'nome_curso',
        'id_servidor',
        'codigo_inscricao',
        'situacao_inscricao',
        'data_situacao',
        'created_at',
        'updated_at'
    ];

    public function turma()
    {
        return $this->hasOne('App\Models\Turmas','id', 'id_turma');
    }

    public function servidor()
    {
        return $this->hasOne('App\Models\Servidor','id', 'id_servidor');
    }

    public function certificado()
    {
        return $this->hasOne('App\Models\Certificados','id_inscricao','id');
    }
}
