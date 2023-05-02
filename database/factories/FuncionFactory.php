<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\Sala;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcion>
 */
class FuncionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => Carbon::today()->addDays(rand(-30, 30))->addHours(rand(12, 22)),
            'precio' => 100*rand(6,12),
            'sala_id' => Sala::all()->random()->id,
        ];
    }
}