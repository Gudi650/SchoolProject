<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    
    //the view function for announcements page
    public function viewAnnouncements()
    {
        return view('TeacherPanel.announcements');
    }



    //function to add the announcement
    public function addAnnouncement(Request $request)
    {

        //get the user details
        $userDetails = $this->getUserDetails();

        //get the teacher id
        $teacherId = $userDetails['teacherId'];
        //get the school id
        $schoolId = $userDetails['schoolId'];

        //validate the request
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'audience_type.*' => 'required|in:all_students,all_teachers,all,by_subject',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // max 5MB
        ]);

        //dump the validation data
        dd($data);

    }


    //get the details of the user
    protected function getUserDetails()
    {
        
        //get the user id 
        $userId = auth()->id();

        //get the teacherId of the user
        $teacherId = Teacher::where('user_id', $userId)->value('id');

        //get the schoolId of the user
        $schoolId = Teacher::where('user_id', $userId)->value('school_id');

        //return the details
        return [
            'userId' => $userId,
            'teacherId' => $teacherId,
            'schoolId' => $schoolId
        ];

    }


}
