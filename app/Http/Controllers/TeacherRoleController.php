<?php

namespace App\Http\Controllers;

use App\Models\AssignedRole;
use App\Models\Teacher;
use App\Models\TeacherRole;
use Illuminate\Http\Request;

class TeacherRoleController extends Controller
{
    //show the available teacher roles page
    public function showAssignRoles()
    {
        //get the teacher data from the teachers table in db
        $teachers =Teacher::all();


        //get the roles from the teacherroles table in db
        $teacherroles = TeacherRole::all();


        //pass down the data to the view
        return view('TeacherPanel.assignroles', ['teacherroles' => $teacherroles, 'teachers' => $teachers]);
    }



    //assign roles to teachers
    public function assignTeacherRoles(Request $request)
    {
        //validate the requested data
        $validatedData = $request->validate([
            'teacher_id' => 'required|array',
            'teacher_role_id' => 'required|array',
            'teacher_id.*' => 'exists:teachers,id',
            'teacher_role_id.*' => 'exists:teacher_roles,id',
        ]);

        //loop through the validated data and assign roles
        foreach ($validatedData['teacher_id'] as $index=> $teacherId)
        {
            //obtaining the role assigned to the corresponding teacher
            $teacherRoleID = $validatedData['teacher_role_id'][$index]??null;

            //check $teaecherRoleID is not null
            if($teacherRoleID)
            {
                //create a new role row in the assigned_role table
                AssignedRole::create([
                    'teacher_id' => $teacherId,
                    'teacher_role_id' => $teacherRoleID,
                ]);
            }
        }

        //redirect back with success message
        return redirect()->back()->with('success', 'Teacher roles assigned successfully.');


    }

}
