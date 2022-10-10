<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->name,
            'occupation'=>$this->faker->domainWord,
            'number1'=>$this->faker->numberBetween(1,10),
            'number2'=>$this->faker->numberBetween(1,10)
        ];
    }
}
