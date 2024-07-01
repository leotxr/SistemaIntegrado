<?php

namespace Modules\HelpDesk\Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\HelpDesk\Entities\TicketStatus;

class ExtraServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\HelpDesk\Entities\ExtraService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->words(5, true),
            'sector' => fake()->word(),
            'requester_id' => User::all()->random()->id,
            'item' => fake()->words(2, true),
            'action' => fake()->words(2, true),
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}

