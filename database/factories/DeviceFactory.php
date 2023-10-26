<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->lexify('device-????'),
            'serial_number' => fake()->regexify('[A-Z]{5}[0-5]{4}'),
            'ip_address' => fake()->numerify('192.168.254.##'),
            'mac_address' => fake()->macAddress(),
            'active' => 1,
            'device_type_id' => 1,
            'last_response' => fake()->dateTimeInInterval('-1 week', '+3 days')

        ];
    }
}
