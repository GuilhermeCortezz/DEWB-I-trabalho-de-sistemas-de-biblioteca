@extends('layouts.app')

@section('title', 'Editar Usuário')
@section('header', 'Editar Usuário')

@section('content')
    <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
        @csrf
        @method('PUT')

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="{{ old('nome', $usuario->nome) }}" required><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}" required><br>

        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $usuario->telefone) }}"><br><br>

        <input type="submit" value="Editar Usuario">
    </form>
    <p><a href="{{ route('usuarios.index') }}">Voltar para a lista de usuários</a></p>
@endsection

