@extends('layouts.app')

@section('title', 'Editar Reserva')
@section('header', 'Editar Reserva')

@section('content')
    <form method="POST" action="{{ route('reservas.update', $reserva) }}">
        @csrf
        @method('PUT')

        <label for="usuario_id">Usuário:</label><br>
        <select id="usuario_id" name="usuario_id" required>
            @foreach ($usuarios as $u)
                <option value="{{ $u->id }}" {{ old('usuario_id', $reserva->usuario_id) == $u->id ? 'selected' : '' }}>
                    {{ $u->nome }}
                </option>
            @endforeach
        </select><br>

        <label for="livro_id">Livro:</label><br>
        <select id="livro_id" name="livro_id" required>
            @foreach ($livros as $l)
                <option value="{{ $l->id }}" {{ old('livro_id', $reserva->livro_id) == $l->id ? 'selected' : '' }}>
                    {{ $l->titulo }}
                </option>
            @endforeach
        </select><br>

        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            @foreach ($statusOptions as $opcao)
                <option value="{{ $opcao }}" {{ old('status', $reserva->status) == $opcao ? 'selected' : '' }}>
                    {{ $opcao }}
                </option>
            @endforeach
        </select><br><br>

        <input type="submit" value="Salvar Alterações">
    </form>
    <p><a href="{{ route('reservas.index') }}">Voltar para a lista</a></p>
@endsection

