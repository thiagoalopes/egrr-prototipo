<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Servidor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'funcao',
        'email',
        'celular',
        'telefone',
        'senha',
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
