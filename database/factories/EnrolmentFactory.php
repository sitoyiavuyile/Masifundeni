<?php
// database/factories/EnrolmentFactory.php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Enrolment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrolmentFactory extends Factory
{
    protected $model = Enrolment::class;

    public function definition(): array
    {
        return [
            'student_id'  => User::factory()->student(),
            'course_id'   => Course::factory(),
            'status'      => $this->faker->randomElement(['pending', 'active', 'completed', 'dropped']),
            'enrolled_at' => now(),
        ];
    }

    public function active(): static
    {
        return $this->state(['status' => 'active']);
    }

    public function completed(): static
    {
        return $this->state([
            'status'       => 'completed',
            'completed_at' => now(),
        ]);
    }

    public function dropped(): static
    {
        return $this->state(['status' => 'dropped']);
    }
}