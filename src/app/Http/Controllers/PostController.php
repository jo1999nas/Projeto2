<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        // Lógica para mostrar um post
    }

    public function create()
    {
        // Retorna a view com o formulário de criação
    }

    public function store(Request $request)
    {
        // 1. Validar os dados do $request
        // 2. Criar o post no banco de dados
        // 3. Redirecionar para algum lugar (ex: o novo post)
    }

    public function edit(Post $post)
    {
        // Retorna a view com o formulário de edição e os dados do $post
    }

    public function update(Request $request, Post $post)
    {
        // 1. Validar os dados do $request
        // 2. Atualizar o post no banco de dados
        // 3. Redirecionar
    }

    public function destroy(Post $post)
    {
        // 1. Apagar o post do banco de dados
        // 2. Redirecionar
    }
}