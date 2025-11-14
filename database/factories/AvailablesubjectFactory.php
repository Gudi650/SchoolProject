<?php

namespace Database\Factories;

use App\Models\Availablesubject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\availablesubject>
 */
class AvailablesubjectFactory extends Factory
{

    // Define the model's default state.
    protected $model = Availablesubject::class;

    // Static counter to track which sample to return
    protected static int $index = 0;
    
    public function definition(): array
    {
        

        //making premade samples for available classes
        $classAvailableSamples = [
            ['subject_name' => 'Mathematics', 'school_id' => 1],
            ['subject_name' => 'Science', 'school_id' => 1],
            ['subject_name' => 'English Language', 'school_id' => 1],
            ['subject_name' => 'Kiswahili', 'school_id' => 1],
            ['subject_name' => 'Social Studeies', 'school_id' => 1],
            ['subject_name' => 'French Language', 'school_id' => 1],
        ];

        $count = count($classAvailableSamples);
        $i = $count ? self::$index % $count : 0;
        $sample = $classAvailableSamples[$i];
        
        // advance index safely (keeps cycling)
        self::$index = ($i + 1) % max($count, 1);
        
        return $sample;
    }

    
}
