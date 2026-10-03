@extends('layouts.app')

@section('title', 'Reservas')
@section('header', 'Reservas')

@section('content')
    <form class="pesquisa" method="GET" action="{{ route('reservas.index') }}">
        <input type="text" name="busca" placeholder="Pesquisar por usuário, livro ou status..." value="{{ $busca }}">
        <input type="submit" value="Pesquisar">
        @if ($busca !== '')
            <a href="{{ route('reservas.index') }}" style="margin-left: 10px;">Limpar busca</a>
        @endif
    </form>

    <p><a href="{{ route('reservas.create') }}">+ Adicionar nova reserva</a></p>

    @if ($reservas->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Livro</th>
                    <th>Data da Reserva</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->id }}</td>
                        <td>{{ $reserva->usuario ? $reserva->usuario->nome : '-' }}</td>
                        <td>{{ $reserva->livro ? $reserva->livro->titulo : '-' }}</td>
                        <td>{{ $reserva->data_reserva ? $reserva->data_reserva->format('d/m/Y H:i') : '-' }}</td>
                        <td>{{ $reserva->status }}</td>
                        <td class="acoes">
                            <a class="btn-editar" href="{{ route('reservas.edit', $reserva) }}">Editar</a>
                            <form method="POST" action="{{ route('reservas.destroy', $reserva) }}" onsubmit="return confirm('Excluir esta reserva?');">
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
        <p>Nenhuma reserva encontrada.</p>
    @endif
@endsection

