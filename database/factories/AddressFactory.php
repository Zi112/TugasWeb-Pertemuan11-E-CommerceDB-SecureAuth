<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'label'       => fake()->randomElement(['Rumah', 'Kantor', 'Kos']),
            'recipient'   => fake()->name(),
            'phone'       => fake()->phoneNumber(),
            'street'      => fake()->streetAddress(),
            'city'        => fake()->city(),
            'postal_code' => fake()->postcode(),
        ];
    }
}
