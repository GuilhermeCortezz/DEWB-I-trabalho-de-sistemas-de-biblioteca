@extends('layouts.app')

@section('title', 'Autores')
@section('header', 'Autores')

@section('content')
    <form class="pesquisa" method="GET" action="{{ route('autores.index') }}">
        <input type="text" name="busca" placeholder="Pesquisar por nome..." value="{{ $busca }}">
        <input type="submit" value="Pesquisar">
        @if ($busca !== '')
            <a href="{{ route('autores.index') }}" style="margin-left: 10px;">Limpar busca</a>
        @endif
    </form>

    <p><a href="{{ route('autores.create') }}">+ Adicionar novo autor</a></p>

    @if ($autores->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nacionalidade</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($autores as $autor)
                    <tr>
                        <td>{{ $autor->id }}</td>
                        <td>{{ $autor->nome }}</td>
                        <td>{{ $autor->nacionalidade ?? '-' }}</td>
                        <td>{{ $autor->data_nascimento ? $autor->data_nascimento->format('d/m/Y') : '-' }}</td>
                        <td class="acoes">
                            <a class="btn-editar" href="{{ route('autores.edit', $autor) }}">Editar</a>
                            <form method="POST" action="{{ route('autores.destroy', $autor) }}" onsubmit="return confirm('Excluir este autor? Não será possível se ele tiver livros cadastrados.');">
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
        <p>Nenhum autor encontrado.</p>
    @endif
@endsection
