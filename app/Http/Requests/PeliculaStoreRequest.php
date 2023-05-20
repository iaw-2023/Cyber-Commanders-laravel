<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeliculaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "nombre"  => "unique:peliculas,nombre",
            "poster"  => "unique:peliculas,poster",
            "duracion" => "gt:0"
        ];
    }

    public function messages()
    {
        return [
            "nombre.unique" => "Error, ya existe una pelicula con ese nombre",
            "poster.unique" => "Error, ya existe ese poster",
            "duracion.gt" => "La duracion de la pelicula debe ser mayor a 0 minutos"
        ];
    }
}
