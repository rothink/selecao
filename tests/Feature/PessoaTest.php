<?php

namespace Tests\Feature;

use App\Pessoa;
use Tests\TestCase;

class PessoaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListarPessoas()
    {
        $response = $this->get('/api/pessoa');
        $response->assertStatus(200, $response->getStatusCode());
    }

    public function testeListarPessoaById()
    {
        $id = factory(Pessoa::class)->create()->id;
        $response = $this->get('/api/pessoa/' . $id);

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $id
                ]
            ]);
    }
}
