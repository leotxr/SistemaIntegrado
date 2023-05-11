<?php

namespace Modules\Autorizacao\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProtocolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Autorizacao\Entities\Protocol::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'paciente_name' => fake()->name(),
            'paciente_id' => fake()->randomNumber(5, false),
            'created_at' => fake()->date('Y-m-d'),
            'updated_at' => fake()->date('Y-m-d'),

        ];
    }
}

