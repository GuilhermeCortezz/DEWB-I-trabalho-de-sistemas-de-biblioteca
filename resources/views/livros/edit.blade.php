@extends('layouts.app')

@section('title', 'Editar Livro')
@section('header', 'Editar Livro')

@section('content')
    <form method="POST" action="{{ route('livros.update', $livro) }}">
        @csrf
        @method('PUT')

        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $livro->titulo) }}" required><br>

        <label for="isbn">ISBN:</label><br>
        <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $livro->isbn) }}"><br>

        <label for="ano_publicacao">Ano de publicação:</label><br>
        <input type="number" id="ano_publicacao" name="ano_publicacao" value="{{ old('ano_publicacao', $livro->ano_publicacao) }}"><br>

        <label for="quantidade_estoque">Quantidade em estoque:</label><br>
        <input type="number" id="quantidade_estoque" name="quantidade_estoque" value="{{ old('quantidade_estoque', $livro->quantidade_estoque) }}" min="0" required><br>

        <label for="autor_id">Autor:</label><br>
        <select id="autor_id" name="autor_id" required>
            @foreach ($autores as $autor)
                <option value="{{ $autor->id }}" {{ old('autor_id', $livro->autor_id) == $autor->id ? 'selected' : '' }}>
                    {{ $autor->nome }}
                </option>
            @endforeach
        </select><br><br>

        <input type="submit" value="Salvar Alterações">
    </form>
    <p><a href="{{ route('livros.index') }}">Voltar para a lista</a></p>
@endsection

