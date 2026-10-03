<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\Usuario;
use App\Models\Livro;
use App\Models\Reserva;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $machado = Autor::create([
            'nome' => 'Machado de Assis',
            'nacionalidade' => 'Brasileira',
            'data_nascimento' => '1839-06-21',
        ]);

        $clarice = Autor::create([
            'nome' => 'Clarice Lispector',
            'nacionalidade' => 'Brasileira',
            'data_nascimento' => '1920-12-10',
        ]);

        $orwell = Autor::create([
            'nome' => 'George Orwell',
            'nacionalidade' => 'Britânica',
            'data_nascimento' => '1903-06-25',
        ]);

        $usuario1 = Usuario::create([
            'nome' => 'João Silva',
            'email' => 'joao.silva@email.com',
            'telefone' => '(11) 98765-4321',
        ]);

        $usuario2 = Usuario::create([
            'nome' => 'Maria Oliveira',
            'email' => 'maria.oliveira@email.com',
            'telefone' => '(21) 99887-6655',
        ]);

        $usuario3 = Usuario::create([
            'nome' => 'Carlos Souza',
            'email' => 'carlos.souza@email.com',
            'telefone' => '(31) 91234-5678',
        ]);

        $livro1 = Livro::create([
            'titulo' => 'Dom Casmurro',
            'isbn' => '978-8535914849',
            'ano_publicacao' => 1899,
            'quantidade_estoque' => 5,
            'autor_id' => $machado->id,
        ]);

        $livro2 = Livro::create([
            'titulo' => 'Memórias Póstumas de Brás Cubas',
            'isbn' => '978-8535914856',
            'ano_publicacao' => 1881,
            'quantidade_estoque' => 3,
            'autor_id' => $machado->id,
        ]);

        $livro3 = Livro::create([
            'titulo' => 'A Hora da Estrela',
            'isbn' => '978-8532508102',
            'ano_publicacao' => 1977,
            'quantidade_estoque' => 4,
            'autor_id' => $clarice->id,
        ]);

        $livro4 = Livro::create([
            'titulo' => '1984',
            'isbn' => '978-8535914863',
            'ano_publicacao' => 1949,
            'quantidade_estoque' => 7,
            'autor_id' => $orwell->id,
        ]);

        Reserva::create([
            'usuario_id' => $usuario1->id,
            'livro_id' => $livro1->id,
            'data_reserva' => now()->subDays(2),
            'status' => 'Ativa',
        ]);

        Reserva::create([
            'usuario_id' => $usuario2->id,
            'livro_id' => $livro3->id,
            'data_reserva' => now()->subDay(),
            'status' => 'Pendente',
        ]);

        Reserva::create([
            'usuario_id' => $usuario3->id,
            'livro_id' => $livro4->id,
            'data_reserva' => now(),
            'status' => 'Concluida',
        ]);
    }
}
