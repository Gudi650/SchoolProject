<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class PayrollConfigurationsController extends Controller
{
    //

    //show the payroll configuration page
    public function showPayrollConfiguration()
    {
        //get the teachers of the school
        $teachers = $this->getTeachers();


        return view('AccountantPanel.payrolls.payrollsetting', ['teachers' => $teachers]);
        
    }


    //function to get the teachers of the school and show them in the payroll configuration page
    protected function getTeachers()
    {
        //get the user id of the currently logged in user
        //$userId = Auth::id();

        //get the school id of the currently logged in user
        //$schoolId = Auth::user()->teachers->first()->school_id;

        //get the teachers of the school
        //$teachers = Teacher::where('school_id', $schoolId)->get();
        $teachers = Teacher::where('school_id', 1)->get();

        //return the teachers array
        return $teachers;

    }

}
