<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('autores', AutorController::class);
Route::resource('livros', LivroController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('reservas', ReservaController::class);
