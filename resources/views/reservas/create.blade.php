@extends('layouts.app')

@section('title', 'Adicionar Reserva')
@section('header', 'Adicionar Reserva')

@section('content')
    <form method="POST" action="{{ route('reservas.store') }}">
        @csrf

        <label for="usuario_id">Usuário:</label><br>
        <select id="usuario_id" name="usuario_id" required>
            <option value="">-- selecione um usuário --</option>
            @foreach ($usuarios as $u)
                <option value="{{ $u->id }}" {{ old('usuario_id') == $u->id ? 'selected' : '' }}>
                    {{ $u->nome }}
                </option>
            @endforeach
        </select><br>

        <label for="livro_id">Livro:</label><br>
        <select id="livro_id" name="livro_id" required>
            <option value="">-- selecione um livro --</option>
            @foreach ($livros as $l)
                <option value="{{ $l->id }}" {{ old('livro_id') == $l->id ? 'selected' : '' }}>
                    {{ $l->titulo }}
                </option>
            @endforeach
        </select><br>

        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            @foreach ($statusOptions as $opcao)
                <option value="{{ $opcao }}" {{ old('status', 'Pendente') == $opcao ? 'selected' : '' }}>
                    {{ $opcao }}
                </option>
            @endforeach
        </select><br><br>

        <input type="submit" value="Adicionar Reserva">
    </form>

    @if ($usuarios->isEmpty())
        <p class="erro">Cadastre ao menos um usuário antes de criar reservas. <a href="{{ route('usuarios.create') }}">Adicionar usuário</a></p>
    @endif
    @if ($livros->isEmpty())
        <p class="erro">Cadastre ao menos um livro antes de criar reservas. <a href="{{ route('livros.create') }}">Adicionar livro</a></p>
    @endif

    <p><a href="{{ route('reservas.index') }}">Voltar para a lista</a></p>
@endsection

