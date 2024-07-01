<?php

namespace Modules\HelpDesk\Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\HelpDesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketPriority;
use Modules\HelpDesk\Entities\TicketSubCategory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\HelpDesk\Entities\Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category_id = TicketCategory::all()->random(1)->first()->id;
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->words(3, true),
            'requester_id' => User::all()->random()->id,
            'user_id' => NULL,
            'ticket_open' => date('Y-m-d h:i:s'),
            'status_id' => 1,
            'category_id' => TicketCategory::all()->random()->id,
            'sub_category_id' => TicketSubCategory::all()->random()->id,

        ];
    }
}

