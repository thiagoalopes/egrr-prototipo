<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificados extends Model
{
    use HasFactory;

    protected $table = 'tb_certificados';
    public $timestamps = true;

    protected $fillable = [
        'id_servidor',
        'nome_servidor',
        'cpf',
        'matricula',
        'tipo_vinculo',
        'id_curso',
        'id_inscricao',
        'curso',
        'professor',
        'data_inicio',
        'data_termino',
        'carga_horaria',
        'aproveitamento',
        'diretor_egrr',
        'assinatura_diretor_egrr',
        'secretario_segad',
        'conteudos',
        'assinatura_secretario_segad',
        'data_emissao',
        'id_servidor_emitente',
        'created_at',
        'update_at',
    ];

    protected $casts = [
        'conteudos'=> 'array'
    ];
}
