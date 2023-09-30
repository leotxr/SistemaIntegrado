<?php

namespace Modules\Orcamento\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Orcamento\Entities\Budget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_name' => fake()->name(),
            'patient_phone' => fake()->phoneNumber(),
            'initial_status_id' => 1,
            'user_id' => $rand2 = rand(7, 9),
            'budget_status_id' => rand(2, 4),
            'last_user_id' => $rand2,
            'budget_type_id' => rand(1, 3),
            'budget_date' => date('Y-m-d')



        ];
    }
}

