@extends('layouts.app')

@section('title', 'Adicionar Livro')
@section('header', 'Adicionar Livro')

@section('content')
    <form method="POST" action="{{ route('livros.store') }}">
        @csrf

        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required><br>

        <label for="isbn">ISBN:</label><br>
        <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}"><br>

        <label for="ano_publicacao">Ano de publicação:</label><br>
        <input type="number" id="ano_publicacao" name="ano_publicacao" value="{{ old('ano_publicacao') }}"><br>

        <label for="quantidade_estoque">Quantidade em estoque:</label><br>
        <input type="number" id="quantidade_estoque" name="quantidade_estoque" value="{{ old('quantidade_estoque', 1) }}" min="0" required><br>

        <label for="autor_id">Autor:</label><br>
        <select id="autor_id" name="autor_id" required>
            <option value="">-- selecione um autor --</option>
            @foreach ($autores as $autor)
                <option value="{{ $autor->id }}" {{ old('autor_id') == $autor->id ? 'selected' : '' }}>
                    {{ $autor->nome }}
                </option>
            @endforeach
        </select><br><br>

        <input type="submit" value="Adicionar Livro">
    </form>

    @if ($autores->isEmpty())
        <p class="erro">Cadastre ao menos um autor antes de adicionar livros. <a href="{{ route('autores.create') }}">Adicionar autor</a></p>
    @endif

    <p><a href="{{ route('livros.index') }}">Voltar para a lista</a></p>
@endsection

