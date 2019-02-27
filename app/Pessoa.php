<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition()
 */
class Pessoa extends Model
{
    protected $fillable = [];

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

    /**
     * Pessoa constructor.
     * Função criada para adicionar automaticamente os atributos no fillable
     * Criada por causa do swagger
     */
    public function __construct()
    {
        $this->fillable = [
            $this->nome,
            $this->sobrenome
        ];
    }
}
