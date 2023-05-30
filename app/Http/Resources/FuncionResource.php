<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Pelicula;
use App\Models\Sala;

class FuncionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'inicio' => $this->fecha,
            'precio' => $this->precio,
            'pelicula' => Pelicula::find($this->pelicula_id),
            'sala' => Sala::find($this->sala_id),
        ];
    }
}