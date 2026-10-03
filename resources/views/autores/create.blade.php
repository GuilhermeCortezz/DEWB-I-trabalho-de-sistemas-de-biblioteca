@extends('layouts.app')

@section('title', 'Adicionar Autor')
@section('header', 'Adicionar Autor')

@section('content')
    <form method="POST" action="{{ route('autores.store') }}">
        @csrf
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required><br>

        <label for="nacionalidade">Nacionalidade:</label><br>
        <input type="text" id="nacionalidade" name="nacionalidade" value="{{ old('nacionalidade') }}"><br>

        <label for="data_nascimento">Data de nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}"><br><br>

        <input type="submit" value="Adicionar Autor">
    </form>
    <p><a href="{{ route('autores.index') }}">Voltar para a lista</a></p>
@endsection

