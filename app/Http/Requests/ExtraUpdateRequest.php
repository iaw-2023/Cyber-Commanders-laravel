<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExtraUpdateRequest extends FormRequest
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
        $producto = $this->producto;
        $tamaño = $this->tamaño;
        return [
                'producto' => [Rule::unique('extras')->ignore($this->id)->where(function ($query) use($producto,$tamaño) {
                    return $query->where('producto', $producto)
                    ->where('tamaño', $tamaño);
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            "producto.unique" => "Error, ya existe esa combinacion de producto y tamaño",
        ];
    }
}
