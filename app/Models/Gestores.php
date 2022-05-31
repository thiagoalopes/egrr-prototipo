<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestores extends Model
{
    use HasFactory;

    protected $table = 'tb_assinatura_gestores';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'nome_secretario',
        'nome_diretor_egrr',
        'imagem_assinatura_secretario',
        'imagem_assinatura_diretor',
        'created_at',
        'updated_at'
    ];
}
