<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherRole>
 */
class TeacherRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //redefining the job titles to use in tinker

        $jobTitles = [
            'Head Teacher',
            'Discipline Teacher',
            'Academic Teacher',
            'Class Teacher',
            'Teacher',
            'Librarian',
        ];


        return [
            'name' => $this->faker->randomElement($jobTitles),
        ];
    }
}
