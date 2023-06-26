<?php
 
namespace App\Rules;
 
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;
use App\Models\Funcion;
use App\Models\Pelicula;
use App\Models\Sala;
use Carbon\Carbon;

 
class FechaValidaUpdateRule implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];
 
    // ...
 
    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $pelicula_id=Arr::get($this->data,'pelicula');
        $fecha=Arr::get($this->data,'fecha');
        $sala_id=Arr::get($this->data,'sala');
        $id=Arr::get($this->data,'id');

        $pelicula = Pelicula::findOrFail($pelicula_id);
        $inicio = Carbon::createFromFormat('Y-m-d\TH:i',$fecha); 
        $fin = Carbon::createFromFormat('Y-m-d\TH:i', $fecha)->addMinutes($pelicula->duracion);
 
        if(Funcion::where('sala_id','=',$sala_id)->where('id','!=',$id)->where(function($query) use ($inicio, $fin){$query->whereBetween('fecha', [$inicio,$fin])->orWhereBetween('fin', [$inicio,$fin]);})->count()>0)
        {
            $fail('Error! La sala ya esta ocupada con otra funcion en ese momento. Pruebe en otra sala u en otra fecha');
        }
        
    }
}



  
