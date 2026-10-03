<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = null;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
    ];

    protected function casts(): array
    {
        return [
            'data_cadastro' => 'datetime',
        ];
    }

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'usuario_id');
    }

    public function livros(): BelongsToMany
    {
        return $this->belongsToMany(Livro::class, 'reservas', 'usuario_id', 'livro_id')
                    ->withPivot('id', 'data_reserva', 'status');
    }
}
