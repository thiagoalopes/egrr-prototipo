<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autenticacao extends Model
{
    use HasFactory;

    protected $table = 'autenticacao';
    protected $primaryKey = 'cpf';
}
