<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EntradaStoreRequest extends FormRequest
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
            "extras.*.id"  => "distinct|exists:extras,id",
            "extras.*.cantidad"  => "gt:-1",
            "funcion_id"  => "exists:funciones,id",           
        ];
    }

    public function messages()
    {
        return [
            "extras.*.id.distinct" => "Error, seleccionaste un producto varias veces en vez de modificar su cantidad",
            "extras.*.id.exists" => "Error, no se encontro el producto seleccionado",
            "extras.*.cantidad.gt" => "Error, has seleccionado un valor negativo para algun producto",
            "funcion_id.exists" => "Error, la funcion no existe",
        ];
    }


}