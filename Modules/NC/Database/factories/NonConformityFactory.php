<?php

namespace Modules\NC\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NonConformityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\NC\Entities\NonConformity::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'description'=> fake()->realText($maxNbChars = 200, $indexSize = 2),
            'source_user_id'=> rand(1, 35),
            'n_c_classification_id'=> rand(1, 10),
            'n_c_status_id'=> 1,
            'n_c_date'=> fake()->date('Y-m-d')
        ];
    }
}

