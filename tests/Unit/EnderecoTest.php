<?php

namespace Tests\Unit;

use App\Endereco;
use App\Repositories\EnderecoRepository;
use Tests\TestCase;

class EnderecoTest extends TestCase
{

    protected $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = new EnderecoRepository($this->app);
    }

    /**
     * Teste cadastro de endereco
     */
    public function testCadastroEndereco()
    {
        $endereco = factory(Endereco::class)->create();
        $this->assertInstanceOf(Endereco::class, $endereco);
        $this->assertArrayHasKey('cep', $endereco->getAttributes());
        $this->assertArrayHasKey('logradouro', $endereco->getAttributes());
        $this->assertArrayHasKey('pessoa_id', $endereco->getAttributes());
        $this->assertArrayHasKey('bairro', $endereco->getAttributes());
        $this->assertArrayHasKey('localidade', $endereco->getAttributes());
    }

    /**
     * Excluir endereco
     * @group excluir-endereco
     */
    public function testExcluirEndereco()
    {
        $endereco = factory(Endereco::class)->create();
        $res = $this->repo->destroy($endereco->id);
        $this->assertEquals(200, $res->getStatusCode());
    }

    /**
     * Tetse que lista todas as pessoas
     * @group listar-enderecos
     */
    public function testListarEnderecos()
    {
        $enderecos = $this->repo->all();
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
