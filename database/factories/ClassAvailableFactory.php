<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassAvailable>
 */
class ClassAvailableFactory extends Factory
{
    // Static counter to track which sample to return
    protected static int $index = 1;

    public function definition(): array
    {
        $classAvailableSamples = [
            ['name' => 'Grade 1', 'school_id' => 1],
            ['name' => 'Grade 2', 'school_id' => 1],
            ['name' => 'Grade 3', 'school_id' => 1],
            ['name' => 'Grade 4', 'school_id' => 1],
            ['name' => 'Grade 5', 'school_id' => 1],
            ['name' => 'Grade 6', 'school_id' => 1],
        ];

        // Get the current sample and increment the index
        $sample = $classAvailableSamples[self::$index];

        // Prevent overflow
        self::$index++;

        return $sample;
    }
}
