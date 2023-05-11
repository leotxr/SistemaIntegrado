<?php

namespace Modules\Autorizacao\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Autorizacao\Entities\Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->word(),
            'paciente_id' => fake()->randomNumber(5, false),
            'created_at' => fake()->date('Y-m-d'),
            'updated_at' => fake()->date('Y-m-d'),
        ];
    }
}

