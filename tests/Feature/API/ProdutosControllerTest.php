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
                '0.valor_unitario' => 'double',
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
                'valor_unitario' => 'double',
            ]);

            $json->whereAll([
                'id' => $product->id,
                'nome' => $product->nome,
                'valor_unitario' => $product->valor_unitario,
            ]);
        });
    }

    /**
     * Testa endpoint criar um produto.
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

    /**
     * Testa endpoint para editar um produto.
     *
     * @return void
     */
    public function test_put_produto_endpoint()
    {
        Produto::factory(1)->createOne();
        $product = [
            'nome' => "Atualizando nome",
            'valor_unitario' => '110.55',
        ];
        $response = $this->putJson('/api/produtos/1', $product);

        $response->assertStatus(200);

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

    /**
     * Testa endpoint para editar um produto com método patch.
     *
     * @return void
     */
    public function test_patch_produto_endpoint()
    {
        Produto::factory(1)->createOne();
        $product = [
            'nome' => "Atualizando nome",
        ];
        $response = $this->patchJson('/api/produtos/1', $product);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($product) {
            $json->hasAll([
                'id',
                'nome',
                'valor_unitario',
                'created_at',
                'updated_at',
            ]);

            $json->where('nome', $product['nome']);
        });
    }

    /**
     * Testa endpoint para deletar um produto.
     *
     * @return void
     */
    public function test_delete_produto_endpoint()
    {
        Produto::factory(1)->createOne();

        $response = $this->deleteJson('/api/produtos/1');

        $response->assertStatus(204);
    }

     /**
     * Testa criar um produto com dados inválidos.
     *
     * @return void
     */
    public function test_post_produto_should_validate_when_try_create_a_invalid_product()
    {
        $response = $this->postJson('/api/produtos', []);

        // dd($response->baseResponse);

        $response->assertStatus(422);

        $response->assertJson(function (AssertableJson $json) {
            $json->hasAll(['message', 'errors']);

            $json->where('errors.nome.0', 'O campo Nome é obrigatório!')
                ->where('errors.valor_unitario.0', 'O campo Valor Unitário é obrigatório!');
        });
    }
}
