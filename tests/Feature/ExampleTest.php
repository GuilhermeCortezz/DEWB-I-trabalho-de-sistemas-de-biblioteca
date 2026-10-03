<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test home page returns 200 and displays library welcome text.
     */
    public function test_the_home_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sistema de Biblioteca');
        $response->assertSee('Autores');
        $response->assertSee('Livros');
        $response->assertSee('Usuários');
        $response->assertSee('Reservas');
    }
}
