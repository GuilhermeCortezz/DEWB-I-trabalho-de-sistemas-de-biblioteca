@extends('layouts.app')

@section('title', 'Livros')
@section('header', 'Livros')

@section('content')
    <form class="pesquisa" method="GET" action="{{ route('livros.index') }}">
        <input type="text" name="busca" placeholder="Pesquisar por título ou autor..." value="{{ $busca }}">
        <input type="submit" value="Pesquisar">
        @if ($busca !== '')
            <a href="{{ route('livros.index') }}" style="margin-left: 10px;">Limpar busca</a>
        @endif
    </form>

    <p><a href="{{ route('livros.create') }}">+ Adicionar novo livro</a></p>

    @if ($livros->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>ISBN</th>
                    <th>Ano</th>
                    <th>Estoque</th>
                    <th>Autor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livros as $livro)
                    <tr>
                        <td>{{ $livro->id }}</td>
                        <td>{{ $livro->titulo }}</td>
                        <td>{{ $livro->isbn ?? '-' }}</td>
                        <td>{{ $livro->ano_publicacao ?? '-' }}</td>
                        <td>{{ $livro->quantidade_estoque }}</td>
                        <td>{{ $livro->autor ? $livro->autor->nome : '-' }}</td>
                        <td class="acoes">
                            <a class="btn-editar" href="{{ route('livros.edit', $livro) }}">Editar</a>
                            <form method="POST" action="{{ route('livros.destroy', $livro) }}" onsubmit="return confirm('Excluir este livro? Reservas associadas a ele também serão removidas.');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Excluir">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum livro encontrado.</p>
    @endif
@endsection

