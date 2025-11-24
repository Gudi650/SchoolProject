<?php

namespace App\Http\Controllers;

use App\Models\AssignedRole;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //return the view of the page
    public function registerStudentAttendance()
    {

        //get the id of the teacher
        $teacherId = auth()->id();

        //get the teacher logged in
        $teacher = Teacher::where('user_id', $teacherId)->first();

        //now get the assigned role of the teacher
        $teacherRole = $teacher->assignedroles;
        
        //iterate the roles to get the role
        foreach($teacherRole as $role){
            $roleName[] = $role->teacherRole->name;
        }
        
        //check if the array includes 'Class Teacher'
        if(!in_array('Class Teacher', $roleName)){
            
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
            //get the class the teacher is assigned to as the class teacher
            //the teacherRole used in the whereRelation is the variable teacherRole
            $assignedClass = AssignedRole::where('teacher_id', $teacher->id)
                                            ->whereRelation('teacherRole', 'name', 'Class Teacher')
                                            ->first();

        //get the class name
        $className = $assignedClass->classAvailable->name;

            //get the class id from the assigned class
            $classId = $assignedClass->classAvailable->id;
        
        //get the students assigned to that class of the teacher
        $students = Student::where('class_id',$classId)->latest()->get();


        //declared variable for table number
        $Tablenumber = 1;

        return view('TeacherPanel.registerattendance',[
            'students' => $students,
            'className' => $className,
            'Tablenumber' => $Tablenumber
        ]);
    }


    


}
