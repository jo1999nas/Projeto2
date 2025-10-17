<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/css/style.css?v={{ time() }}">
    </head>
    <body>
        <header>
            <h1>Blog</h1>
            <nav>
                <a href="/">Início</a>
                @auth
                <a href="{{ route('posts.create') }}">Criar novo post</a>
                <a href="#">Teste</a>
                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <a href="/logout" onclick="event.preventDefault(); this.closest('form').submit();"> Sair </a>
                </form>
                @endauth
                @guest
                <a href="/login">Entrar</a>
                <a href="/register">Cadastrar</a>
                @endguest
            </nav>
        </header>
        <main class ="container">
            @yield('content')
        </main>
        <footer>
            &copy; {{ date('Y') }} Meu Blog. Todos os direitos reservados.
        </footer>
    </body>
</html>