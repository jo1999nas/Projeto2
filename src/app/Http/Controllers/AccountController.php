<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show(Account $account)
    {
        // 1. Carregar os posts da conta
        $account->load(['user', 'posts' => function ($query) {
            $query->latest();
        }]);
        // 2. Retornar a view do perfil
        return view('accounts.show', ['account' => $account]);
        // return $account;
    }
    
    public function followers(Account $account)
    {
        // 1. Buscar os seguidores da $account
        $account->load('user', 'followers')->paginate(10);
        // 2. Retornar a view que lista os seguidores
        return view('accounts.followers', ['account' => $account]);
        // return $account;
    }

    public function following(Account $account)
    {
        // 1. Buscar quem a $account está seguindo
        $account->load('user', 'following')->paginate(10);
        // 2. Retornar a view que lista os usuários
        return view('accounts.following', ['account' => $account]);
        // return $account;
    }
}