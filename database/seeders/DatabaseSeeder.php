<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\School;
use App\Models\Availablesubject;
use App\Models\ClassAvailable;
use App\Models\TeacherRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 3 schools
        School::factory(3)->create();

        // Create 6 available subjects
        Availablesubject::factory(6)->create();

        // Create 6 class levels
        ClassAvailable::factory(6)->create();

        // Create 6 teacher roles
        TeacherRole::factory(6)->create();

        // Create test user
        User::factory()->create([
            'fname' => 'Test',
            'lname' => 'User',
            'email' => 'test@example.com',
        ]);
    }
}
