@extends('layouts.app')

@section('title', 'Usuários')
@section('header', 'Listar Usuários do Banco de Dados')

@section('content')
    <form class="pesquisa" method="GET" action="{{ route('usuarios.index') }}">
        <input type="text" name="busca" placeholder="Pesquisar por nome ou e-mail..." value="{{ $busca }}">
        <input type="submit" value="Pesquisar">
        @if ($busca !== '')
            <a href="{{ route('usuarios.index') }}" style="margin-left: 10px;">Limpar busca</a>
        @endif
    </form>

    <p><a href="{{ route('usuarios.create') }}">+ Adicionar novos usuários</a></p>

    @if ($usuarios->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Cadastrado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->telefone ?? '-' }}</td>
                        <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : ($usuario->data_cadastro ? \Carbon\Carbon::parse($usuario->data_cadastro)->format('d/m/Y H:i') : '-') }}</td>
                        <td class="acoes">
                            <a class="btn-editar" href="{{ route('usuarios.edit', $usuario) }}">Editar</a>
                            <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" onsubmit="return confirm('Excluir este usuário? Reservas associadas também serão removidas.');">
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
        <p>Nenhum usuário encontrado.</p>
    @endif
@endsection

