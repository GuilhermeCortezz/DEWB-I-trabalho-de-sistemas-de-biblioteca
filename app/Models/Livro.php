<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';

    const UPDATED_AT = null;

    protected $fillable = [
        'titulo',
        'isbn',
        'ano_publicacao',
        'quantidade_estoque',
        'autor_id',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'livro_id');
    }

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, 'reservas', 'livro_id', 'usuario_id')
                    ->withPivot('id', 'data_reserva', 'status');
    }
}
