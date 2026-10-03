<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema de Biblioteca')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>@yield('header', 'Sistema de Biblioteca')</h1>
    
    <nav>
        <a href="{{ route('home') }}">Início</a>
        <a href="{{ route('autores.index') }}">Autores</a>
        <a href="{{ route('livros.index') }}">Livros</a>
        <a href="{{ route('usuarios.index') }}">Usuários</a>
        <a href="{{ route('reservas.index') }}">Reservas</a>
    </nav>

    @if (session('success'))
        <div class="msg">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="erro">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="erro">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</body>
</html>

