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
            // 'sub_category_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name(),
        ];
    }
}
