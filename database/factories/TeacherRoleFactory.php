<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherRole>
 */
class TeacherRoleFactory extends Factory
{
    // Static counter to track which sample to return
    protected static int $index = 0;

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

        $count = count($jobTitles);
        $i = $count ? self::$index % $count : 0;
        $role = $jobTitles[$i];
        
        // Advance index safely (keeps cycling)
        self::$index = ($i + 1) % max($count, 1);

        return [
            'name' => $role,
        ];
    }
}
