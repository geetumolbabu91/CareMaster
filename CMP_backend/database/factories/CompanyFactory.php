<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email_address'     => fake()->unique()->safeEmail(),
            'logo'              => fake()->image('storage/app/public/images',100,100, null, false),
            'website_address'   => fake()->url()
           ];
    }
}
