<?php

namespace Tests\Feature;

use App\Pessoa;
use Tests\TestCase;

class EnderecoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListarEnderecos()
    {
        $response = $this->get('/api/endereco');
        $response->assertStatus(200, $response->getStatusCode());
    }

    public function testeListarEnderecoById()
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
