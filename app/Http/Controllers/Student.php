<?php

namespace App\Http\Controllers;

use App\Models\GeneratedTimetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Student extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get the logged-in user
        $user = Auth::user();

        if (!$user) {
            // no authenticated user - show the welcome page without student data
            return view('welcome');
        }

        // retrieve the student record associated with the user using the defined relation
        $student = $user->students;

        // retrieve the parents data
        $parent = $student ? $student->parent_data : null;

        // return the view with student data (may be null)
        return view('welcome', compact('student', 'parent'));
    }

    public function showTimetable()
    {
        $student = Auth::user()?->students;
        $className = $student?->classAvailables?->name;
        $scheduleByDay = collect();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        if ($student?->class_id) {
            $entries = GeneratedTimetable::with(['subject', 'teacher'])
                ->where('class_id', $student->class_id)
                ->where('school_id', $student->school_id)
                ->orderBy('start_time')
                ->get()
                ->groupBy('day_of_week');

            foreach ($days as $day) {
                $scheduleByDay[$day] = $entries->get($day, collect());
            }
        }

        return view('StudentPanel.timetable', compact('student', 'className', 'scheduleByDay', 'days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
