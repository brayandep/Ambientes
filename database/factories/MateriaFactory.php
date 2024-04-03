<?php

namespace Database\Factories;

use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class MateriaFactory extends Factory
{
    protected $model = Materia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'departamento'=> $this->faker->randomElement(['Departamento1','Departamento2','Departamento3','Departamento4']), 
            'carrera'=> $this->faker->sentence(), 
            'nombre'=> $this->faker->sentence(), 
            'codigo' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT), 
            'nivel'=> $this->faker->randomElement(['A','B','C','D','E','F','G','H','I','J']), 
            'cantGrupo' => $this->faker->randomElement([1,2,3,4,5])
        ];
    }
}
