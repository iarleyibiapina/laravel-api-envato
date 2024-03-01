<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // create a random state where could be Billed, Paid or void
        $status = $this->faker->randomElement(['B', 'P', 'V']);

        return [
            // Relationship between Invoice and Customer id
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->numberBetween(100, 20000),
            'status' => $status,
            'billed_date' => $this->faker->dateTimeThisDecade(),
            'PAID_date' => $status == 'P' ? $this->faker->dateTimeThisDecade() : NULL,
        ];
    }
}
