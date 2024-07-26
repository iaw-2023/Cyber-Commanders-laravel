<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Entrada extends Model
{
    use HasFactory;
    protected $table = 'entradas' ;

    public function funcion(): BelongsTo
    {
        return $this->belongsTo(Funcion::class);
    }

    public function extras(): BelongsToMany
    {
        return $this->belongsToMany(Extra::class, 'extras_entradas', 'entradas_id', 'extras_id')
        ->withPivot('cantidad');
    }
    
}


