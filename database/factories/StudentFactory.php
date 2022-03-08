<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
    	return [
    	    //
            'name' => $this->faker->name(),
            'dob' => $this->faker->date(),
            'registration_no' =>$this->faker->unique()->phoneNumber,
            'guardian_name' => $this->faker->name,
            'guardian_no' => $this->faker->unique()->phoneNumber,
    	];
    }
}
