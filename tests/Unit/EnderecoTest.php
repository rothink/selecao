<?php

namespace Tests\Unit;

use App\Endereco;
use Tests\TestCase;

class EnderecoTest extends TestCase
{
    /**
     * Teste cadastro de endereco
     */
    public function testCadastroEndereco()
    {
        $endereco = factory(Endereco::class)->create();
        $this->assertInstanceOf(Endereco::class, $endereco);
    }

    /**
     * Tetse que lista todas as pessoas
     */
    public function testListarPessoas()
    {
        $enderecos = Endereco::all();
        foreach ($enderecos as $endereco ){
            $this->objectHasAttribute('pessoa_id', $endereco);
            $this->objectHasAttribute('cep', $endereco);
            $this->objectHasAttribute('logradouro', $endereco);
            $this->objectHasAttribute('bairro', $endereco);
            $this->objectHasAttribute('localidade', $endereco);
            $this->assertIsNumeric($endereco->pessoa_id);
            $this->assertInstanceOf(Endereco::class, $endereco);
        }
    }

    /**
     * teste recuperar endereco por id de pessoa
     * @group listar-endereco-por-pessoa
     */
    public function testListarEnderecoPorIdPessoa()
    {
        $endereco = factory(Endereco::class)->create();
        $enderecoWhere = Endereco::where('pessoa_id', '=', $endereco->pessoa_id)->firstOrFail();
        $this->assertEquals($endereco->pessoa_id, $enderecoWhere->pessoa_id);
    }
}
