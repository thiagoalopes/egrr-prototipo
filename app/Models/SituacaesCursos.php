<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaesCursos extends Model
{
    use HasFactory;

    protected $table = 'tb_situacao_curso';

    protected $fillable = [
        'situacao',
    ];

}
