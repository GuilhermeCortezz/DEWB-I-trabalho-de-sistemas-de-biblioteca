@extends('layouts.app')

@section('title', 'Editar Autor')
@section('header', 'Editar Autor')

@section('content')
    <form method="POST" action="{{ route('autores.update', $autor) }}">
        @csrf
        @method('PUT')

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="{{ old('nome', $autor->nome) }}" required><br>

        <label for="nacionalidade">Nacionalidade:</label><br>
        <input type="text" id="nacionalidade" name="nacionalidade" value="{{ old('nacionalidade', $autor->nacionalidade) }}"><br>

        <label for="data_nascimento">Data de nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento', $autor->data_nascimento ? $autor->data_nascimento->format('Y-m-d') : '') }}"><br><br>

        <input type="submit" value="Salvar Alterações">
    </form>
    <p><a href="{{ route('autores.index') }}">Voltar para a lista</a></p>
@endsection

