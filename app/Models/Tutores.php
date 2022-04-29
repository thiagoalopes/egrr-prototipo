<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutores extends Model
{
    use HasFactory;

    protected $table = 'tb_tutor';

    protected $fillable = [
        'nome',
        'cpf',
        'celular',
        'email',
        'created_at',
        'update_at',
    ];

}
