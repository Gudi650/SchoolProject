<?php

namespace App\Http\Controllers;

use App\Models\AssignedSubject;
use App\Models\availablesubject;
use App\Models\ClassAvailable;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AssignedSubjectController extends Controller
{
    //show the assigned subjects page
    public function showAssignedSubjects()
    {
        //try to get data from the database if needed
        //get the subject available in particular school use the school id from session or auth user

        //get the id of the user
        $userId = auth()->id();

        // teacher model for the logged in user (single model)
        $currentTeacher = Teacher::where('user_id', $userId)->first();

        //get the school id safely
        $schoolId = $currentTeacher->school_id ?? $currentTeacher->school?->id;

        //get subjects for that school (collection) if needed
        $subjects = availablesubject::where('school_id', $schoolId)->get();

        //get available classes for that school
        $Classes = ClassAvailable::where('school_id', $schoolId)->get();

        //get all teachers for that school
        $teachers = Teacher::where('school_id', $schoolId)->get();

        //get the data from assigned-teachers table
        $assignedTeachers = AssignedSubject::where('school_id', $schoolId)->with(['teacher', 'availablesubject', 'classAvailable'])->get();


        //return the view
        //pass the data as well to the view
        return view ('TeacherPanel.assignsubjects',['teachers' => $teachers, 'subjects' => $subjects, 'classes' => $Classes, 'assignedTeachers' => $assignedTeachers]);
        
    }


    //assign subject to teachers
    public function assignSubjectToTeacher(Request $request)
    {
        //validate the request
        $validated = $request->validate([
            'class_id' => 'required|exists:class-availables,id',
            'availablesubject_id' => 'required|exists:availablesubjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'school_id' => 'required|exists:schools,id',
        ]);

        //now create new row at assigned subjects table
        AssignedSubject::create([
            'class_id' => $validated['class_id'],
            'availablesubject_id' => $validated['availablesubject_id'],
            'teacher_id' => $validated['teacher_id'],
            'school_id' => $validated['school_id'],
        ]);
        

        //redirect back with success message
        return redirect()->back()->with('success', 'Subject assigned to teacher successfully.');
    }


}
