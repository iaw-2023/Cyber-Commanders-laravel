<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Models\Funcion;
use App\Models\Pelicula;
use App\Models\Sala;
use App\Rules\FechaValidaRule;
use App\Rules\FechaValidaUpdateRule;
use Illuminate\Support\Arr;

class FuncionUpdateRequest extends FormRequest
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
        $val = new FechaValidaUpdateRule();
      
        return [
            'fecha' => [$val],

        ];
        
    }

}

//Funcion::where('fecha','<=','2023-10-11 21:11:00')->where('fin','>=','2023-10-11 23:02:00')->count()  


