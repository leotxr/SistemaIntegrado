<?php

namespace Modules\NC\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NCClassificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\NC\Entities\NCClassification::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'name'=> fake()->word(),
            'description'=> fake()->sentence(3),
            'color'=> fake()->hexColor()
        ];
    }
}

