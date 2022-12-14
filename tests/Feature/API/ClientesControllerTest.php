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
                '0.estado' => 'string',
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
                '0.estado',
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
                '0.estado' => $client->estado,
                '0.cep' => $client->cep,
                '0.email' => $client->email,
                '0.data_nascimento' => $client->data_nascimento,
            ]);
        });
    }

    /**
     * Testa endpoint para pegar um cliente.
     *
     * @return void
     */
    public function test_show_cliente_endpoint()
    {
        $client = Cliente::factory(1)->createOne();

        $response = $this->getJson('/api/clientes/' . $client->id);

        // dd($response->baseResponse);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($client) {
            $json->hasAll([
                'id',
                'nome',
                'cpf',
                'logradouro',
                'numero',
                'bairro',
                'complemento',
                'cidade',
                'estado',
                'cep',
                'email',
                'data_nascimento',
                'created_at',
                'updated_at',
            ]);

            $json->whereAllType([
                'id' => 'integer',
                'nome' => 'string',
                'cpf' => 'string',
                'logradouro' => 'string',
                'numero' => 'string',
                'bairro' => 'string',
                'complemento' => 'string',
                'cidade' => 'string',
                'estado' => 'string',
                'cep' => 'string',
                'email' => 'string',
                'data_nascimento' => 'string',
            ]);

            $json->whereAll([
                'id' => $client->id,
                'nome' => $client->nome,
                'cpf' => $client->cpf,
                'logradouro' => $client->logradouro,
                'numero' => $client->numero,
                'bairro' => $client->bairro,
                'complemento' => $client->complemento,
                'cidade' => $client->cidade,
                'estado' => $client->estado,
                'cep' => $client->cep,
                'email' => $client->email,
                'data_nascimento' => $client->data_nascimento,
            ]);
        });
    }

    /**
     * Testa endpoint criar um cliente.
     *
     * @return void
     */
    public function test_post_cliente_endpoint()
    {
        $client = Cliente::factory(1)->makeOne()->toArray();

        $response = $this->postJson('/api/clientes', $client);

        // dd($response->baseResponse);

        $response->assertStatus(201);

        $response->assertJson(function (AssertableJson $json) use($client) {
            $json->hasAll([
                'id',
                'nome',
                'cpf',
                'logradouro',
                'numero',
                'bairro',
                'complemento',
                'cidade',
                'cep',
                'email',
                'data_nascimento',
                'created_at',
                'updated_at',
            ]);

            $json->whereAll([
                'nome' => $client['nome'],
                'cpf' => $client['cpf'],
                'logradouro' => $client['logradouro'],
                'numero' => $client['numero'],
                'bairro' => $client['bairro'],
                'complemento' => $client['complemento'],
                'cidade' => $client['cidade'],
                'cep' => $client['cep'],
                'email' => $client['email'],
                'data_nascimento' => $client['data_nascimento'],
            ])->etc();
        });
    }

    /**
     * Testa endpoint para editar um cliente.
     *
     * @return void
     */
    public function test_put_cliente_endpoint()
    {
        $client = Cliente::factory(1)->createOne();
        $clientEdited = [
            'nome' => "Atualizando nome",
            'cpf' => $client->cpf,
            'logradouro' => "Atualizando logradouro",
            'numero' => "Atualizando n??mero",
            'bairro' => "Atualizando bairro",
            'complemento' => "Atualizando complemento",
            'cidade' => $client->cidade,
            'cep' => $client->cep,
            'estado' => $client->estado,
            'email' => $client->email,
            'data_nascimento' => $client->data_nascimento,
        ];
        $response = $this->putJson('/api/clientes/1', $clientEdited);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($clientEdited) {
            $json->hasAll([
                'id',
                'nome',
                'cpf',
                'logradouro',
                'numero',
                'bairro',
                'complemento',
                'cidade',
                'estado',
                'cep',
                'email',
                'data_nascimento',
                'created_at',
                'updated_at',
            ]);

            $json->whereAll([
                'nome' => $clientEdited['nome'],
                'cpf' => $clientEdited['cpf'],
                'logradouro' => $clientEdited['logradouro'],
                'numero' => $clientEdited['numero'],
                'bairro' => $clientEdited['bairro'],
                'complemento' => $clientEdited['complemento'],
                'cidade' => $clientEdited['cidade'],
                'estado' => $clientEdited['estado'],
                'cep' => $clientEdited['cep'],
                'email' => $clientEdited['email'],
                'data_nascimento' => $clientEdited['data_nascimento'],
            ])->etc();
        });
    }

    /**
     * Testa endpoint para editar um cliente com m??todo patch.
     *
     * @return void
     */
    public function test_patch_cliente_endpoint()
    {
        Cliente::factory(1)->createOne();
        $clientEdited = [
            'nome' => "Atualizando nome",
            'logradouro' => "Atualizando logradouro",
        ];
        $response = $this->patchJson('/api/clientes/1', $clientEdited);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($clientEdited) {
            $json->hasAll([
                'id',
                'nome',
                'cpf',
                'logradouro',
                'numero',
                'bairro',
                'complemento',
                'cidade',
                'estado',
                'cep',
                'email',
                'data_nascimento',
                'created_at',
                'updated_at',
            ]);

            $json->where('nome', $clientEdited['nome']);
            $json->where('logradouro',$clientEdited['logradouro']);
        });
    }

    /**
     * Testa endpoint para deletar um cliente.
     *
     * @return void
     */
    public function test_delete_cliente_endpoint()
    {
        Cliente::factory(1)->createOne();

        $response = $this->deleteJson('/api/clientes/1');

        $response->assertStatus(204);
    }

    /**
     * Testa criar um cliente com dados inv??lidos.
     *
     * @return void
     */
    public function test_post_cliente_should_validate_when_try_create_a_invalid_client()
    {
        $response = $this->postJson('/api/clientes', []);

        // dd($response->baseResponse);

        $response->assertStatus(422);

        $response->assertJson(function (AssertableJson $json) {
            $json->hasAll(['message', 'errors']);

            $json->where('errors.nome.0', 'O campo Nome ?? obrigat??rio!')
                ->where('errors.cpf.0', 'O campo CPF ?? obrigat??rio!')
                ->where('errors.logradouro.0', 'O campo Logradouro ?? obrigat??rio!')
                ->where('errors.numero.0', 'O campo N??mero ?? obrigat??rio!')
                ->where('errors.bairro.0', 'O campo Bairro ?? obrigat??rio!')
                ->where('errors.cidade.0', 'O campo Cidade ?? obrigat??rio!')
                ->where('errors.estado.0', 'O campo Estado ?? obrigat??rio!')
                ->where('errors.cep.0', 'O campo CEP ?? obrigat??rio!')
                ->where('errors.email.0', 'O campo E-Mail ?? obrigat??rio!')
                ->where('errors.data_nascimento.0', 'O campo Data de Nascimento ?? obrigat??rio!');
        });
    }
}
