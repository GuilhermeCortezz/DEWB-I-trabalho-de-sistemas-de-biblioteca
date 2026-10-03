@extends('layouts.app')

@section('title', 'Adicionar Usuário')
@section('header', 'Adicionar Usuários do Banco de Dados')

@section('content')
    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required><br>

        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}"><br><br>

        <input type="submit" value="Adicionar Usuario">
    </form>
    <p><a href="{{ route('usuarios.index') }}">Voltar para a lista de usuários</a></p>
@endsection

