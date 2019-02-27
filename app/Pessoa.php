<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition()
 */
class Pessoa extends Model
{
    protected $fillable = ['nome','sobrenome'];

    protected $table = 'pessoa';

    /**
     * Nome da pessoa
     * @var string
     * @SWG\Property()
     */
    public $nome = 'nome';

    /**
     * Sobrenome da pessoa
     * @var string
     * @SWG\Property()
     */
    public $sobrenome = 'sobrenome';
}
