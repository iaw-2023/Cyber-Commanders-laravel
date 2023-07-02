<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeliculaResource extends JsonResource
{
       /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'duracion' => $this->duracion,
            'nombre' => $this->nombre,
            'poster' => $this->poster,
        ];
    }
}
