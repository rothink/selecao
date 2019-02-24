<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'Endereco';
    protected $fillable  = ['cep', 'logradouro', 'pessoa_id', 'complemento', 'bairro', 'localidade'];
}
