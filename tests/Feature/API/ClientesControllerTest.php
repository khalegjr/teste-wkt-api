<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cliente;
use Illuminate\Testing\Fluent\AssertableJson;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa endpoint de listagem de clientes.
     *
     * @return void
     */
    public function test_get_clientes_endpoint()
    {
        $clients = Cliente::factory(3)->create();

        $response = $this->getJson('/api/clientes');

        // dd($response->baseResponse);

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        $response->assertJson(function (AssertableJson $json) use($clients) {
            $json->whereAllType([
                '0.id' => 'integer',
                '0.nome' => 'string',
                '0.cpf' => 'string',
                '0.logradouro' => 'string',
                '0.numero' => 'string',
                '0.bairro' => 'string',
                '0.complemento' => 'string',
                '0.cidade' => 'string',
                '0.cep' => 'string',
                '0.email' => 'string',
                '0.data_nascimento' => 'string',
            ]);

            $json->hasAll([
                '0.id',
                '0.nome',
                '0.cpf',
                '0.logradouro',
                '0.numero',
                '0.bairro',
                '0.complemento',
                '0.cidade',
                '0.cep',
                '0.email',
                '0.data_nascimento',
            ]);

            $client = $clients->first();
            $json->whereAll([
                '0.id' => $client->id,
                '0.nome' => $client->nome,
                '0.cpf' => $client->cpf,
                '0.logradouro' => $client->logradouro,
                '0.numero' => $client->numero,
                '0.bairro' => $client->bairro,
                '0.complemento' => $client->complemento,
                '0.cidade' => $client->cidade,
                '0.cep' => $client->cep,
                '0.email' => $client->email,
                '0.data_nascimento' => $client->data_nascimento,
            ]);
        });
    }
}
