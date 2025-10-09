<?php

// database/factories/AccountFactory.php
namespace Database\Factories;

use App\Models\User; // Importar o model User
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Usa o 'userName' do Faker para o nome da conta
            'name' => fake()->unique()->userName(), 
            
            // Cria um novo User e associa o ID dele a esta Account
            'user_id' => User::factory(),
        ];
    }
}
