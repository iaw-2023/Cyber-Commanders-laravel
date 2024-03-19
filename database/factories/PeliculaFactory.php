<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcion>
 */
class PeliculaFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /**$faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));

        return [
         'nombre' => $faker->movie, 
         'duracion'=> fake()->numberBetween(80, 180),
         'poster'=> fake()->imageUrl
        ];*/
    }

}
