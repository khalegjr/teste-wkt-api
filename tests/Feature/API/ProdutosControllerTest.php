<?php

namespace Tests\Feature\API;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProdutosControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa endpoint de listagem de produtos.
     *
     * @return void
     */
    public function test_get_produtos_endpoint()
    {
        $products = Produto::factory(3)->create();

        $response = $this->getJson('/api/produtos');

        // dd($response->baseResponse);

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        $response->assertJson(function (AssertableJson $json) use($products) {
            $json->hasAll([
                '0.id',
                '0.nome',
                '0.valor_unitario',
            ]);

            $json->whereAllType([
                '0.id' => 'integer',
                '0.nome' => 'string',
                '0.valor_unitario' => 'string',
            ]);

            $product = $products->first();
            $json->whereAll([
                '0.id' => $product->id,
                '0.nome' => $product->nome,
                '0.valor_unitario' => $product->valor_unitario,
            ]);
        });
    }

    /**
     * Testa endpoint para pegar um produto.
     *
     * @return void
     */
    public function test_show_produto_endpoint()
    {
        $product = Produto::factory(1)->createOne();

        $response = $this->getJson('/api/produtos/' . $product->id);

        // dd($response->baseResponse);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($product) {
            $json->hasAll([
                'id',
                'nome',
                'valor_unitario',
                'created_at',
                'updated_at',
            ]);

            $json->whereAllType([
                'id' => 'integer',
                'nome' => 'string',
                'valor_unitario' => 'string',
            ]);

            $json->whereAll([
                'id' => $product->id,
                'nome' => $product->nome,
                'valor_unitario' => $product->valor_unitario,
            ]);
        });
    }

    /**
     * Testa endpoint criar um cliente.
     *
     * @return void
     */
    public function test_post_produto_endpoint()
    {
        $product = Produto::factory(1)->makeOne()->toArray();

        $response = $this->postJson('/api/produtos', $product);

        // dd($response->baseResponse);

        $response->assertStatus(201);

        $response->assertJson(function (AssertableJson $json) use($product) {
            $json->hasAll([
                'id',
                'nome',
                'valor_unitario',
                'created_at',
                'updated_at',
            ]);

            $json->whereAll([
                'nome' => $product['nome'],
                'valor_unitario' => $product['valor_unitario'],
            ])->etc();
        });
    }
}
