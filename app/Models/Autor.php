<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';

    const UPDATED_AT = null;

    protected $fillable = [
        'nome',
        'nacionalidade',
        'data_nascimento',
    ];

    protected function casts(): array
    {
        return [
            'data_nascimento' => 'date:Y-m-d',
            'created_at' => 'datetime',
        ];
    }

    public function livros(): HasMany
    {
        return $this->hasMany(Livro::class, 'autor_id');
    }
}
