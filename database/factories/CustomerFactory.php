<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // random type, where could be INDIVIDUAL or BUSINESS
        $type = $this->faker->randomElement(['I', 'B']);
        // If type is INDIVIDUAL, create a random name if not create a business name
        $name = $type == 'I' ? $this->faker->name() : $this->faker->company();

        return [
            'name' => $name,
            'type' => $type,
            'email' => $this->faker->email(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'posta_code' => $this->faker->postCode()
        ];
    }
}
