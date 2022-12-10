<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->bothify('???? ??? #?'),
            'valor_unitario' => $this->faker->regexify('[A-Z]{5}[0-4]{3} [A-Z]{3}'),
        ];
    }
}
