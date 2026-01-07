<?php

namespace App\Http\Controllers\Announcements;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{


    /*

        rules for intended_audience field:
        0 - all
        2 - all_students
        3 - all_teachers
        4 - by_subject
        5 - custom audience

    */


    //view function to display announcemennts in the student panel
    public function viewAnnouncements()
    {

        //get the student details
        $userDetails = $this->getUserDetails();

        //get the school id
        $schoolId = $userDetails['schoolId'];

        //get the announcements for students in specific school
        $announcements = $this->getStudentAnnouncements($schoolId);

        //pass the announcements to the view
        return view('StudentPanel.announcements', [
            'announcements' => $announcements,
        ]);

    }


    //function to get the details of the user
    protected function getUserDetails()
    {

        //get the user id
        $userId = auth()->id();

        //dd( $userId);

        //get the student id
        $student =Student::where('user_id', $userId)->get()->first();

        //get the school id
        $schoolId = $student->school_id;

        //dd($schoolId);

        return [
            'studentId' => $student->id,
            'schoolId' => $schoolId,
        ];

        

    }

    //get the announcements for students
    protected function getStudentAnnouncements($schoolId)
    {
        //get the announcements for students
        $announcements = Announcement::where('school_id', $schoolId)
                    ->whereIn('intended_audience', [0, 2]) // 0 - all, 2 - all_students
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return $announcements;
    }


}
