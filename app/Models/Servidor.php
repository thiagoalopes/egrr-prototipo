<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;

    protected $table = 'tb_servidores';
    public $timestamps = true;

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

    public function secretaria()
    {
        return $this->hasOne('App\Models\SecretariaServidores','id', 'id_secretaria_servidores');
    }

    public function inscricoes()
    {
        return $this->hasMany('App\Models\Inscricoes','id_servidor','id');
    }
}
