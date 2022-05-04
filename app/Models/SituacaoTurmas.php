<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoTurmas extends Model
{
    use HasFactory;

    protected $table = 'tb_situacao_turma';
    public $timestamps = true;
}
