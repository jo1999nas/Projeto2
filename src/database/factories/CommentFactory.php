<?php

// database/factories/CommentFactory.php
namespace Database\Factories;

use App\Models\Account; // Importar os models
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Gera uma frase para o comentário
            'comment' => fake()->sentence(),

            // Cria um Post e associa o ID
            'post_id' => Post::factory(),

            // Cria uma Account e associa o ID
            'account_id' => Account::factory(),
        ];
    }
}
