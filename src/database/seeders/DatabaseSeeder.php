<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- 1. CRIAR CONTAS (E USUÁRIOS) ---
        // Cria 20 contas. Como a AccountFactory chama a UserFactory,
        // 20 usuários também serão criados e vinculados automaticamente.
        $accounts = Account::factory(20)->create();
        $this->command->info('20 Accounts with Users created.');

        // --- 2. CRIAR POSTS PARA AS CONTAS ---
        // Para cada conta criada, vamos criar entre 5 e 10 posts.
        $accounts->each(function ($account) {
            Post::factory(rand(5, 10))->create([
                'account_id' => $account->id, // Atribui o post à conta atual do loop
            ]);
        });
        $this->command->info('Posts created for each account.');

        // --- 3. CRIAR COMENTÁRIOS PARA OS POSTS ---
        // Pega todos os posts que acabaram de ser criados.
        $posts = Post::all();
        $posts->each(function ($post) use ($accounts) {
            Comment::factory(rand(2, 8))->create([
                'post_id' => $post->id,
                // Pega uma conta aleatória da coleção inicial para ser a autora do comentário
                'account_id' => $accounts->random()->id, 
            ]);
        });
        $this->command->info('Comments created for posts from random accounts.');

        // --- 4. CRIAR RELAÇÕES DE SEGUIDORES (FOLLOWS) ---
        // Para cada conta, faremos com que ela siga um número aleatório de outras contas.
        $accounts->each(function ($account) use ($accounts) {
            // Pega de 3 a 10 contas aleatórias para seguir.
            // Garante que a conta não siga a si mesma.
            $accountsToFollow = $accounts->where('id', '!=', $account->id)->random(rand(3, 10));
            
            // Usa o método attach() para criar o relacionamento na tabela 'follow'.
            $account->following()->attach($accountsToFollow);
        });
        $this->command->info('Follower relationships created.');
    }
}