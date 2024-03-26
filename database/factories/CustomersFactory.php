<?php

namespace Database\Factories;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'userInformation' => $this->faker->text,
            'phone' => $this->faker->randomNumber(9, true), // Genera un número de 10 dígitos
            'address' => $this->faker->address,
            'care' => $this->faker->text,
            'schedule' => $this->faker->text,
            'pills' => $this->faker->text,
            'observations' => $this->faker->text,
            'familyPhone' => $this->faker->randomNumber(9, true), // Genera un número de 10 dígitos
        ];
    }
}