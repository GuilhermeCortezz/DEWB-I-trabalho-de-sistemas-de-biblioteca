@extends('layouts.app')

@section('title', 'Sistema de Biblioteca')
@section('header', 'Sistema de Biblioteca')

@section('content')
    <p>Bem-vindo! Use o menu acima para gerenciar Autores, Livros, Usuários e Reservas.</p>
    <ul>
        <li><strong>Autores</strong> &rarr; <strong>Livros</strong>: relacionamento 1:N (um autor pode ter vários livros).</li>
        <li><strong>Usuários</strong> &harr; <strong>Livros</strong>: relacionamento N:N através da tabela <em>reservas</em> (um usuário pode reservar vários livros e um livro pode ser reservado por vários usuários ao longo do tempo).</li>
    </ul>
@endsection

