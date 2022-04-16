<?php

namespace Database\Factories;

use App\Models\Operator;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Operator::class;

    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 10),
            'sub_category_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'website' => $this->faker->url,
            'address' => $this->faker->address,
            'note' => $this->faker->text(20),
            'contact_person_name' => $this->faker->name,
            'contact_person_designation' => $this->faker->name,
            'contact_person_phone' => $this->faker->phoneNumber,
            'contact_person_email' => $this->faker->email,
        ];
    }
}
