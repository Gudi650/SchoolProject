<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\availablesubject;
use App\Models\ClassAvailable;
use App\Models\Teacher;
use App\Models\TeacherRole;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    
    //the view function for announcements page
    public function viewAnnouncements()
    {
        //get the user details
        $userDetails = $this->getUserDetails();

        //get the subjects from user details
        $subjects = $userDetails['subjects'];

        return view('TeacherPanel.announcements', [
            'subjects' => $subjects,
        ]);
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



        //store the data in the database
        Announcement::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'school_id' => $schoolId,
            'created_by' => $teacherId,

            //additional fields can be added here
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

        //get the subjects in the school
        $subjects = availablesubject::where('school_id', $schoolId)->get();

        //return the details
        return [
            'userId' => $userId,
            'teacherId' => $teacherId,
            'schoolId' => $schoolId,
            'subjects' => $subjects,
        ];

    }

    //get the class_ids of the school
    protected function getClassIdsOfSchool($schoolId)
    {
        //get the class ids of the school
        $classIds = ClassAvailable::where('school_id', $schoolId)->pluck('id')->toArray();

        //return the class ids
        return $classIds;
    }

    //get the teacher-roles ids of the school
    protected function getTeacherRoleIdsOfSchool($schoolId)
    {
        //get the teacher-roles ids of the school
        $teacherRoleIds = TeacherRole::where('school_id', $schoolId)->pluck('id')->toArray();

        //return the teacher-roles ids
        return $teacherRoleIds;
    }




}
