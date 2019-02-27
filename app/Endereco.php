<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition()
 */
class Endereco extends Model
{
    protected $table = 'Endereco';

    protected $fillable  = [];


    /**
     * Cep do endereco
     * @var integer
     * @SWG\Property()
     */
    public $cep = 'cep';

    /**
     * Logradouro do endereco
     * @var string
     * @SWG\Property()
     */
    public $logradouro = 'logradouro';

    /**
     * ID da pessoa
     * @var integer
     * @SWG\Property()
     */
    public $pessoa_id = 'pessoa_id';

    /**
     * Complemento do endereco
     * @var string
     * @SWG\Property()
     */
    public $complemento = 'complemento';

    /**
     * Bairro do endereco
     * @var string
     * @SWG\Property()
     */
    public $bairro = 'bairro';

    /**
     * Localidade do endereco
     * @var string
     * @SWG\Property()
     */
    public $localidade = 'localidade';

    /**
     * Pessoa constructor.
     * Função criada para adicionar automaticamente os atributos no fillable
     * Criada por causa do swagger
     */
    public function __construct()
    {
        $this->fillable = [
            $this->cep,
            $this->logradouro,
            $this->pessoa_id,
            $this->complemento,
            $this->bairro,
            $this->localidade,
        ];
    }

}
