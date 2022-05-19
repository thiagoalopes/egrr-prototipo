<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificados extends Model
{
    use HasFactory;

    protected $table = 'tb_certificados';
    public $timestamps = true;

    protected $casts = [
        'conteudos'=> 'array'
    ];
}
