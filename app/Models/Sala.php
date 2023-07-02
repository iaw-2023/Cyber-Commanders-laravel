<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Sala extends Model
{
    use HasFactory;

    protected $table = 'salas';
    protected $hidden = ['created_at','updated_at','id'];


    public function funciones(): HasMany
    {
        return $this->hasMany(Funcion::class);
    }

}
