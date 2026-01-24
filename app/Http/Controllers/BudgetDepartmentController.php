<?php

namespace App\Http\Controllers;

use App\Models\budgetDepartment;
use Illuminate\Http\Request;

class BudgetDepartmentController extends Controller
{
    //

    //function to view the page
    public function viewbudgetdepartments()
    {

        //get the departments for a specific school
        
        $departments = $this->fetchbudgetdepartments(1); //hardcoded for now

        //dd($departments);
        

        //return the view with nesesary data needed

        return view('AccountantPanel.budget.manageDepartments', [
            'departments' => $departments,
        ]);

    }

    //function to create a new department
    public function createbudgetdepartment(Request $request)
    {

        //vaidate the request
        $validatedData = $request->validate([
            'department_name' => 'required|string|max:255|unique:budget_departments,department_name',
            'description' => 'nullable|string|max:1000',
        ]);

        /*
        //get the school id from the authenticated user
            $user = auth()->user();
            $school_id = $user->school_id;

            as of now do it manually
        */

            $school_id = 1; //hardcoded for now

        //store the data in the budget_departments table
        //put try and catch block to handle errors

        try{

            budgetDepartment::create([
            'department_name' => $validatedData['department_name'],
            'description' => $validatedData['description'] ?? null,
            'school_id' => $school_id,
        ]);
        }catch(\Exception $e){
            //return back with error message
            return back()->withErrors(['error' => 'Failed to create department: ' . $e->getMessage()])->withInput();

        }

        //redirect back with success message
        return back()->with('success', 'Department created successfully.');

    }


    //function to fetch the budget department data for a specific school

    protected function fetchbudgetdepartments($school_id)
    {
        //fetch all the budget departments from the database
        $departments = budgetDepartment::where('school_id', $school_id)->get();

        return $departments;
    }

}
