<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{


    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            'status' => $this->faker->boolean(),
            'school_id' => School::pluck('id')->random(),
            'order' => $this->faker->numberBetween(1,School::count()),
        ];
    }
}
