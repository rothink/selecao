<?php

namespace Tests\Unit;

use App\Pessoa;
use Tests\TestCase;

class PessoaTest extends TestCase
{

    /**
     * Teste de cadastro de usuário
     */
    public function testCadastroPessoa()
    {
        $pessoa = factory(Pessoa::class)->create();
        $this->assertInstanceOf(Pessoa::class, $pessoa);
    }

    /**
     * Teste ligar pessoas
     */
    public function testListarPessoas()
    {
        $pessoas = Pessoa::all();
        foreach ($pessoas as $pessoa ){
            $this->objectHasAttribute('nome', $pessoa);
            $this->objectHasAttribute('sobrenome', $pessoa);
            $this->assertInstanceOf(Pessoa::class, $pessoa);
        }
    }
}
