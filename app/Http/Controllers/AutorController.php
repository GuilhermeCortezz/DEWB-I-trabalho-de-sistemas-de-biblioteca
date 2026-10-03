<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(Request $request)
    {
        $busca = trim($request->input('busca', ''));

        $query = Autor::query();

        if ($busca !== '') {
            $query->where('nome', 'like', "%{$busca}%");
        }

        $autores = $query->orderBy('nome')->get();

        return view('autores.index', compact('autores', 'busca'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:100'],
            'nacionalidade' => ['nullable', 'string', 'max:50'],
            'data_nascimento' => ['nullable', 'date'],
        ]);

        Autor::create($validated);

        return redirect()->route('autores.index')
            ->with('success', 'Autor adicionado com sucesso!');
    }

    public function edit(Autor $autore)
    {
        $autor = $autore;
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, Autor $autore)
    {
        $autor = $autore;
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:100'],
            'nacionalidade' => ['nullable', 'string', 'max:50'],
            'data_nascimento' => ['nullable', 'date'],
        ]);

        $autor->update($validated);

        return redirect()->route('autores.index')
            ->with('success', 'Autor atualizado com sucesso!');
    }

    public function destroy(Autor $autore)
    {
        $autor = $autore;
        if ($autor->livros()->exists()) {
            return redirect()->route('autores.index')
                ->with('error', 'Não é possível excluir: este autor possui livros cadastrados.');
        }

        $autor->delete();

        return redirect()->route('autores.index')
            ->with('success', 'Autor excluído com sucesso!');
    }
}

