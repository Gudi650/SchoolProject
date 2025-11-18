<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class PostExamResults extends Controller
{
    //function to show the post-exam page
    public function showPostExamPage()
    {
        // obtain the user id
        $userId = auth()->id();

        // obtain the teacher model using the user id
        $teacher = Teacher::where('user_id', $userId)->first();

        // get the assigned teacher subjects (empty collection if no teacher)
        $assigned = $teacher ? $teacher->assignedSubjects : collect();

        // pass the data to the view
        return view('TeacherPanel.postresults', ['allassigned' => $assigned]);
    }
}
