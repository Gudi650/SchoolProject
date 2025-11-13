<?php

namespace App\Http\Controllers;

use App\Models\ClassAvailable;
use App\Models\Teacher;
use App\Models\AssignedRole;
use Illuminate\Http\Request;

class AssignClasses extends Controller
{
    //showing the assign classes page
    public function showAssignClasses()
    {
        // current user id
        $userId = auth()->id();

        // teacher model for the logged in user (single model)
        $currentTeacher = Teacher::where('user_id', $userId)->first();

        // handle missing teacher
        if (! $currentTeacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher profile not found.');
        }

        // get school id safely
        $schoolId = $currentTeacher->school_id ?? $currentTeacher->school?->id;

        // get classes for that school (collection)
        $classes = ClassAvailable::where('school_id', $schoolId)->get();

        // get all teachers from the same school (collection)
        $teachers = Teacher::where('school_id', $schoolId)->get();

        // get assigned roles that have a class_id and belong to those teachers
        $assignedTeachers = AssignedRole::whereIn('teacher_id', $teachers->pluck('id')) ->whereNotNull('class-available_id')->get();

        // pass correctly keyed array to view
        return view('TeacherPanel.assignclasses', ['classes' => $classes, 'teachers' => $teachers, 'assignedTeachers' => $assignedTeachers]);
    }


    //function to handle the form submission for assigning classes
    public function assignClasses(Request $request)
    {

        //validate the data from the form
        $validatedData = $request->validate([
            'class-available_id' => 'required|exists:class-availables,id',
            'teacher_id' => 'required|exists:assigned_roles,teacher_id',
        ]);


        //update class-available_id in assigned_roles table for the selected teacher
        AssignedRole::where('teacher_id', $validatedData['teacher_id'])
            ->update(['class-available_id' => $validatedData['class-available_id']]);

         //redirect back to the assign classes page with a success message
            return redirect()->route('teacher.assignclasses')->with('success', 'Class assigned successfully.');   

    }
}
