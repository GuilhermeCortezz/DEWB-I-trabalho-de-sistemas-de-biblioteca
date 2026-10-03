<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Reserva;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $busca = trim($request->input('busca', ''));

        $query = Reserva::with(['usuario', 'livro']);

        if ($busca !== '') {
            $query->where(function ($q) use ($busca) {
                $q->whereHas('usuario', function ($q2) use ($busca) {
                    $q2->where('nome', 'like', "%{$busca}%");
                })
                ->orWhereHas('livro', function ($q3) use ($busca) {
                    $q3->where('titulo', 'like', "%{$busca}%");
                })
                ->orWhere('status', 'like', "%{$busca}%");
            });
        }

        $reservas = $query->orderBy('data_reserva', 'desc')->get();

        return view('reservas.index', compact('reservas', 'busca'));
    }

    public function create()
    {
        $usuarios = Usuario::orderBy('nome')->get();
        $livros = Livro::orderBy('titulo')->get();
        $statusOptions = ['Pendente', 'Ativa', 'Concluida', 'Cancelada'];

        return view('reservas.create', compact('usuarios', 'livros', 'statusOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario_id' => ['required', 'exists:usuarios,id'],
            'livro_id' => ['required', 'exists:livros,id'],
            'status' => ['required', 'in:Pendente,Ativa,Concluida,Cancelada'],
        ]);

        Reserva::create($validated);

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva adicionada com sucesso!');
    }

    public function edit(Reserva $reserva)
    {
        $usuarios = Usuario::orderBy('nome')->get();
        $livros = Livro::orderBy('titulo')->get();
        $statusOptions = ['Pendente', 'Ativa', 'Concluida', 'Cancelada'];

        return view('reservas.edit', compact('reserva', 'usuarios', 'livros', 'statusOptions'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $validated = $request->validate([
            'usuario_id' => ['required', 'exists:usuarios,id'],
            'livro_id' => ['required', 'exists:livros,id'],
            'status' => ['required', 'in:Pendente,Ativa,Concluida,Cancelada'],
        ]);

        $reserva->update($validated);

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva atualizada com sucesso!');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva excluída com sucesso!');
    }
}

