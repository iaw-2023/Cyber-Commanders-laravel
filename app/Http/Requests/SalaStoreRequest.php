<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaStoreRequest extends FormRequest
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
            "nombre"  => "unique:salas,nombre",
            
        ];
    }

    public function messages()
    {
        return [
            "nombre.unique" => "Error, ya existe una sala con ese nombre",
        ];
    }
}
