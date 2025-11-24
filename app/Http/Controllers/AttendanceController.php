<?php

namespace App\Http\Controllers;

use App\Models\AssignedRole;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //return the view of the page
    public function registerStudentAttendance()
    {

        //get the datas from the centralized function
        $data = $this->fetchreusableData();

        $teacherId = $data['teacherId'];
        $classId = $data['classId'];
        $className = $data['className'];
        $students = $data['students'];
        $schoolId = $data['schoolId'];

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


        //declared variable for table number
        $Tablenumber = 1;

        return view('TeacherPanel.registerattendance',[
            'students' => $students,
            'className' => $className,
            'Tablenumber' => $Tablenumber
        ]);
    }


    //mark all as present
    public function markAllPresent(Request $request)
    {

        //get the data from the centralized function
        $data = $this->fetchreusableData();

        $students = $data['students'];
        $classId = $data['classId'];
        $schoolId = $data['schoolId'];

        //validate the data
        $validatedData = $request->validate([
            'date' => 'required|date',
        ]);

        //save the validated data to variables
        $date = $validatedData['date'];

        //check if the date is not already set for the class in the attendance table

        $existingAttendance = Attendance::where('class-available_id', $classId)
                                    ->where('date', $date)
                                    ->first();

        //if exists, return with error
        if($existingAttendance){
            
            //return to the view with an error message
            return redirect()->back()->with('error', 'Attendance for this date has already been recorded, Please cross-check the date you inserted.');

        }

        //record the data for each student as present
        foreach($students as $student){
            Attendance::create([
                'student_id' => $student->id,
                'class-available_id' => $classId,
                'school_id' => $schoolId,
                'date' => $date,
                'status' => '1', //1 for present
            ]);
            
        }

        //redirect back with success message
        return redirect()->back()->with('success', 'All students have been marked as present for the date '.$date.'.');

    }



    //private function to fetch data to be used in other functions
    private function fetchreusableData()
    {
        //get the id of the teacher
        $teacherId = auth()->id();

        //get the teacher logged in
        $teacher = Teacher::where('user_id', $teacherId)->first();

        //get the school_id
        $schoolId = $teacher->school_id;

        //get the class the teacher is assigned to as the class teacher
        //the teacherRole used in the whereRelation is the variable teacherRole
        $assignedClass = AssignedRole::where('teacher_id', $teacher->id)
                                        ->whereRelation('teacherRole', 'name', 'Class Teacher')
                                        ->first();

        //get the class id from the assigned class
        $classId = $assignedClass->classAvailable->id;

        //get the class name
        $className = $assignedClass->classAvailable->name;

        //get the students assigned to that class of the teacher
        $students = Student::where('class_id',$classId)->latest()->get();


        return [
            'teacherId' => $teacherId,
            'schoolId' => $schoolId,
            'classId' => $classId,
            'className' => $className,
            'students' => $students
        ];
    }


}
