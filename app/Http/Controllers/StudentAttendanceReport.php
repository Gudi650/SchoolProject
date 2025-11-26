<?php

namespace App\Http\Controllers;

use App\Models\AssignedRole;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentAttendanceReport extends Controller
{
    //view function
    public function ViewStudentAttendance()
    {
        //get the common data 
        $data = $this->getCommonData();

        //fetch all data from the array
        $teacher = $data['teacher'];
        $schoolId = $data['schoolId'];
        $role = $data['role'];
        $students = $data['students'];
        $classId = $data['classId'];

       
        //now check if the role is class-teacher if not redirect back with error
        if(!$role ){
            return redirect()->back()->with('error', 'You do not have permission to access this page as you are not assigned any role.');
        }

        //iterate the roles to get the role
        foreach($role as $Role){
            $roleName[] = $role->teacherRole->name;
        }

        //check if the array includes 'Class Teacher'
        if(!in_array('Class Teacher', $roleName)){
            
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }

        
        

        //return view
        return view('TeacherPanel.studentattendance', [
            'students' => $students,
            'schoolId' => $schoolId,
            'classId' => $classId
        ]);
    }







    //function to centralise data needed in multiple methods
    private function getCommonData()
    {
        $userId = auth()->id();

        //get the teacher logged in 
        $teacher = Teacher::where('user_id', $userId)->first();

        //teacherId
        $teacherId = $teacher ? $teacher->id : null;

        //get the schoolId of the logged in teacher
        $schoolId = $teacher ? $teacher->school_id : null;

        //get the role of the teacher
        $role = $teacher ? $teacher->assignedroles()->first() : null;

        //get the class id where the teacher is assigned as class-teacher

        $assignedRole = AssignedRole::where('teacher_id', $teacherId)
                                      ->whereRelation('teacherRole', 'name', 'Class Teacher')
                                      ->first();


        //get the class-id from the assignedRole
        $classId = $assignedRole ->classAvailable->id;

        //get the class name
        $className = $assignedRole->classAvailable->name;

        //get the students of the class from the attendance table

        $students = Attendance::where('school_id', $schoolId)
                                    ->where('class-available_id', $classId)
                                    ->with('student')
                                    ->latest('date')
                                    ->get();


        //create an array to hold the variables
        $data = [
            'teacher' => $teacher,
            'schoolId' => $schoolId,
            'role' => $role,
            'students' => $students,
            'teacherId' => $teacherId,
            'classId' => $classId,
            'className' => $className
        ];

        //return the variables
        return $data;
    }


}
