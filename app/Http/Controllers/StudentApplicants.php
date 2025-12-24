<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\studentEnrollDetails;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentApplicants extends Controller
{

    //view function 
    public function ViewStudentApplicants()
    {
        //call the function to get the data
        $pendingapplicants = $this->getStudentApplicants();

        //dd($pendingapplicants);

        //view the blade file
        return view('TeacherPanel.studentenrollment.applicants', [
            'pendingapplicants' => $pendingapplicants
        ]);
    }

    //reject applicant function
    public function RejectApplicant(Request $request)
    {

        //get the id of the applicant to be rejected
        dd($request->id);

        //now get the id from the request
        $applicantId = $request->id;

        //now check if the id is valid
        if (!$applicantId) {
            return redirect()->back()->with('error', 'Invalid applicant ID.');
        }

        //find the applicant in the studentEnrollDetails table
        $applicant = studentEnrollDetails::find($applicantId);

        if (!$applicant) {
            return redirect()->back()->with('error', 'Applicant not found.');
        }

        // Update the status to rejected
        $applicant->status = 'rejected';
        $applicant->save();

        return redirect()->back()->with('success', 'Applicant rejected successfully.');
        
    }
       


    //function to get the data from the db 
    protected function getStudentApplicants()
    {

        //get the id of the teacher
        $teacherId = auth()->id();

        //get the teacher logged in
        $teacher = Teacher::where('user_id', $teacherId)->first();

        //get the school the teacher belongs to
        $school = School::where('id', $teacher->school_id)->first();


        //first move to the related table student_enroll_details
        //get the applicants of the school with pending status from student_enroll_details
        $pendingApplicants = studentEnrollDetails::with('studentEnrollment')
        ->whereHas('studentEnrollment', function($query) use ($school) {
            $query->where('school_id', $school->id);
        })
        ->where('status', 'pending')
        ->get();

        return $pendingApplicants;


    }

}
