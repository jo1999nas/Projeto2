<?php

// database/factories/PostFactory.php
namespace Database\Factories;

use App\Models\Account; // Importar o model Account
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Gera um ou dois parágrafos de texto para o corpo do post
            'body' => fake()->paragraph(rand(1, 2)),

            // Cria uma nova Account (que por sua vez cria um User) e associa o ID
            'account_id' => Account::factory(),
        ];
    }
}