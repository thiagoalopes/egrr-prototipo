<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professores extends Model
{
    use HasFactory;

    protected $table = 'tb_professor';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'cpf',
        'celular',
        'sexo',
        'email',
        'created_at',
        'update_at',
    ];

}
