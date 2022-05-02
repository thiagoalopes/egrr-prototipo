<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;

    protected $table = 'tb_servidores';

    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'tipo_vinculo',
        'matricula',
        'sexo',
        'cargo',
        'id_secretaria_servidores',
        'email',
        'celular',
        'telefone',
        'created_at',
        'updated_at',
    ];
}
