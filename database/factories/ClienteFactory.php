<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => $this->faker->cpf(false),
            'logradouro' => $this->faker->streetName(),
            'numero' => strval($this->faker->randomNumber(4, false)),
            'bairro' => $this->faker->word(),
            'complemento' => $this->faker->secondaryAddress(),
            'cidade' => $this->faker->city(),
            'cep' => $this->faker->postcode(),
            'email' => $this->faker->safeEmail(),
            'data_nascimento' => $this->faker->date(),
        ];
    }
}
