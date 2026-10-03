<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $busca = trim($request->input('busca', ''));

        $query = Livro::with('autor');

        if ($busca !== '') {
            $query->where(function ($q) use ($busca) {
                $q->where('titulo', 'like', "%{$busca}%")
                  ->orWhereHas('autor', function ($q2) use ($busca) {
                      $q2->where('nome', 'like', "%{$busca}%");
                  });
            });
        }

        $livros = $query->orderBy('titulo')->get();

        return view('livros.index', compact('livros', 'busca'));
    }

    public function create()
    {
        $autores = Autor::orderBy('nome')->get();
        return view('livros.create', compact('autores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'isbn' => ['nullable', 'string', 'max:20', 'unique:livros,isbn'],
            'ano_publicacao' => ['nullable', 'integer'],
            'quantidade_estoque' => ['required', 'integer', 'min:0'],
            'autor_id' => ['required', 'exists:autores,id'],
        ]);

        Livro::create($validated);

        return redirect()->route('livros.index')
            ->with('success', 'Livro adicionado com sucesso!');
    }

    public function edit(Livro $livro)
    {
        $autores = Autor::orderBy('nome')->get();
        return view('livros.edit', compact('livro', 'autores'));
    }

    public function update(Request $request, Livro $livro)
    {
        $validated = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'isbn' => ['nullable', 'string', 'max:20', Rule::unique('livros', 'isbn')->ignore($livro->id)],
            'ano_publicacao' => ['nullable', 'integer'],
            'quantidade_estoque' => ['required', 'integer', 'min:0'],
            'autor_id' => ['required', 'exists:autores,id'],
        ]);

        $livro->update($validated);

        return redirect()->route('livros.index')
            ->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();

        return redirect()->route('livros.index')
            ->with('success', 'Livro excluído com sucesso!');
    }
}

