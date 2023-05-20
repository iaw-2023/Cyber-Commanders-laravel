<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Sala extends Model
{
    use HasFactory;

    protected $table = 'salas';
    use HasFactory;

    public function funciones(): HasMany
    {
        return $this->hasMany(Funcion::class);
    }

}
