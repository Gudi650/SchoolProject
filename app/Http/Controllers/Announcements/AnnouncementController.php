<?php

namespace App\Http\Controllers\Announcements;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\availablesubject;
use App\Models\ClassAvailable;
use App\Models\Teacher;
use App\Models\TeacherRole;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /*

        rules for intended_audience field:
        0 - all
        2 - all_students
        3 - all_teachers
        4 - by_subject
        5 - custom audience

    */
    
    //the view function for announcements page
    public function viewAnnouncements()
    {
        //get the user details
        $userDetails = $this->getUserDetails();

        //get the subjects from user details
        $subjects = $userDetails['subjects'];

        //get the school id
        $schoolId = $userDetails['schoolId'];

        //get the announcements for teachers
        $announcements = $this->getTeacherAnnouncements($schoolId);

        return view('TeacherPanel.announcements', [
            'subjects' => $subjects,
            'announcements' => $announcements,
            'teacherId' => $userDetails['teacherId'],
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
            'audience_type' => 'required|array|min:1',
            'important_note' => 'nullable|string',
            'audience_type.*' => 'required|in:all_students,all_teachers,all,by_subject',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // max 5MB
        ]);

        //now check the intended audience
        if(in_array('all', $data['audience_type'])) {

            //everyone
            $all = 0; 

        } elseif(in_array('all_students', $data['audience_type'])) {

            //only students
            $all_students = 2; 

        } elseif(in_array('all_teachers', $data['audience_type'])) {

            //only school staff
            $all_teachers = 3; 

        } elseif(in_array('by_subject', $data['audience_type'])) {
            
            //by subject
            $by_subject = 4; 

        } else {
            $custom_audience = 5; //custom audience
        }

        //dump the validation data
        //dd($all??$all_students??$all_teachers??$by_subject??$custom_audience??0);

        
        //store the data in the database
        Announcement::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'school_id' => $schoolId,
            'created_by' => $teacherId,
            'important_note' => $data['important_note'] ?? null,

            //now check the intended audience
            'intended_audience' => $all ?? $all_students ?? $all_teachers ?? $by_subject ?? $custom_audience ?? 0,

            //now store the document if exists
            'attachements' => isset($data['attachment']) ? $data['attachment']->store('attachments', 'public') : null,

            //now store the file name 
            'attachment_original_name' => isset($data['attachment']) ? $data['attachment']->getClientOriginalName() : null,

        ]);

         
        

        //now redirect back with success message
        return redirect()->back()->with('success', 'Announcement created successfully.');

    }


    //function to update the announcement
    public function updateAnnouncement(Request $request)
    {
        //get the announcement id from the request
        $announcementId = $request->announcement_id;

        //validate the request
        $data = $request->validate([
            'announcement_id' => 'required|exists:announcements,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'edit_audience_type' => 'required|array|min:1',
            'edit_audience_type.*' => 'required|in:all_students,all_teachers,all,by_subject',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // max 5MB
        ]);

        //process the intended audience
        //now check the intended audience
        if(in_array('all', $data['edit_audience_type'])) {

            //everyone
            $all = 0; 

        } elseif(in_array('all_students', $data['edit_audience_type'])) {

            //only students
            $all_students = 2; 

        } elseif(in_array('all_teachers', $data['edit_audience_type'])) {

            //only school staff
            $all_teachers = 3; 

        } elseif(in_array('by_subject', $data['edit_audience_type'])) {
            
            //by subject
            $by_subject = 4; 

        } else {
            $custom_audience = 5; //custom audience
        }

        
        //now check the creator of the announcement
        $announcement = Announcement::find($announcementId);

        //check if the announcement created_by matches the current user
        if($announcement->created_by != auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this announcement.');
        }

        //now update the announcement in the database
        Announcement::where('id', $announcementId)->update([

            'title' => $data['title'],

            'content' => $data['body'],

            //now check the intended audience
            'intended_audience' => $all ?? $all_students ?? $all_teachers ?? $by_subject ?? $custom_audience ?? 0,

            //now store the document if exists
            'attachements' => isset($data['attachment']) ? $data['attachment']->store('attachments', 'public') : null,

            //now store the file name 
            'attachment_original_name' => isset($data['attachment']) ? $data['attachment']->getClientOriginalName() : null,

        ]);

        //now redirect back with success message
        return redirect()->back()->with('success', 'Announcement updated successfully.');


        //test if the announcement id get to the function
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


    //get the announcements for teachers-only or everyone
    protected function getTeacherAnnouncements($schoolId)
    {
        //get the announcements for teachers
        $announcements = Announcement::where('school_id', $schoolId)
                    ->whereIn('intended_audience', [0, 3]) // 0 - all, 3 - all_teachers
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return $announcements;

    }


}
