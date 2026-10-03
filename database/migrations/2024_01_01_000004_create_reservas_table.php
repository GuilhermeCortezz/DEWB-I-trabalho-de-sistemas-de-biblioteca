<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')
                  ->constrained('usuarios')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('livro_id')
                  ->constrained('livros')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->dateTime('data_reserva')->useCurrent();
            $table->enum('status', ['Pendente', 'Ativa', 'Concluida', 'Cancelada'])->default('Pendente');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
