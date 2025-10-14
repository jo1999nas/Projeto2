<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; // Import adicionado para type hint

class FollowController extends Controller
{
    public function store(Account $account): RedirectResponse
    {
        // Pega a conta do usuário autenticado
        $follower = auth()->user()->account;

        // Adiciona a relação usando o ID da conta
        $follower->following()->attach($account->id);

        // Redireciona de volta com uma mensagem de sucesso
        return back();
    }

    public function destroy(Account $account): RedirectResponse
    {
        // Pega a conta do usuário autenticado
        $follower = auth()->user()->account;
        
        // Remove a relação usando o ID da conta
        $follower->following()->detach($account->id);

        // Redireciona de volta com uma mensagem de sucesso
        return back();
    }
}