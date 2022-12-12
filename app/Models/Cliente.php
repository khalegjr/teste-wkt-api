<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'logradouro',
        'numero',
        'bairro',
        'complemento',
        'cidade',
        'estado',
        'cep',
        'email',
        'data_nascimento',
    ];
}
