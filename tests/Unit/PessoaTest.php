<?php

namespace Tests\Unit;

use App\Pessoa;
use Tests\TestCase;
use App\Repositories\PessoaRepository;

class PessoaTest extends TestCase
{
    protected $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = new PessoaRepository($this->app);
    }

    /**
     * Teste ligar pessoas
     * @group listar-pessoas
     */
    public function testListarPessoas()
    {
        $pessoas = $this->repo->all();
        foreach ($pessoas as $pessoa ){
            $this->objectHasAttribute('nome', $pessoa);
            $this->objectHasAttribute('sobrenome', $pessoa);
            $this->assertInstanceOf(Pessoa::class, $pessoa);
        }
    }

    /**
     * Teste de cadastro de usuário
     */
    public function testCadastroPessoa()
    {
        $pessoa = factory(Pessoa::class)->create();
        $this->assertInstanceOf(Pessoa::class, $pessoa);
        $this->assertArrayHasKey('id', $pessoa->getAttributes());
        $this->assertArrayHasKey('nome', $pessoa->getAttributes());
        $this->assertArrayHasKey('sobrenome', $pessoa->getAttributes());
    }

    /**
     * @group excluir-pessoa
     */
    public function testExcluirPessoa()
    {
        $pessoa = $this->cadastrarPessoa();
        $res = $this->repo->destroy($pessoa->getData()->data->id);
        $this->assertEquals(200, $res->getStatusCode());
    }

    /**
     * @group excluir-pessoa-endereco
     */
    public function testExcluirPessoaComEndereco()
    {
        $arraParams = $this->mountCadastroPessoaEndereco();

        $idPessoa = $this->repo->save($arraParams)->getData()->data->id;
        $this->repo->destroy($idPessoa);
        $enderecos = $this->repo->buscarEnderecosPorIdPessoa($idPessoa);
        $this->assertEquals(0, $enderecos->count());
    }

    /**
     * @group pessoa-endereco
     */
    public function testCadastrarPessoaEndereco()
    {
        $arraParams = $this->mountCadastroPessoaEndereco();

        $idPessoa = $this->repo->save($arraParams)->getData()->data->id;
        $enderecos = $this->repo->buscarEnderecosPorIdPessoa($idPessoa);
        $this->assertEquals(2, $enderecos->count());
    }

    public function mountCadastroPessoaEndereco()
    {
        return [
            'nome' => 'Nome test',
            'sobrenome' => 'Sobrenome test',
            'enderecos' => [
                0 =>
                    [
                        'cep' => '72514684',
                        'logradouro' => 'Qj 42 conjunto B',
                        'complemento' => 'Rua do mercado',
                        'bairro' => 'Rua Augusta',
                        'localidade' => 'RJ',
                    ],
                1 =>
                    [
                        'cep' => '7255487',
                        'logradouro' => 'QND rua 04',
                        'complemento' => 'Beco sem saída',
                        'bairro' => 'Laranjeira',
                        'localidade' => 'SP',
                    ],
            ]
        ];
    }

    /**
     * @return mixed
     */
    public function cadastrarPessoa()
    {
        $arrParams = [
            'nome' => 'Rodrigo teste',
            'sobrenome' => 'Araujo teste'
        ];
        return $this->repo->save($arrParams);
    }
}
