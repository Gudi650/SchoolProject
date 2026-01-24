<?php

namespace App\Http\Controllers;

use App\Models\budgetDepartment;
use App\Models\Teacher;
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
            'departments' => $departments['departments'],
            'totalDepartments' => $departments['total'],
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

    //function to update the departments
    public function updatebudgetdepartment(Request $request, $id)
    {

        //validate the inputs
        $validatedData = $request->validate([
            'department_name' => 'required|string|max:255|unique:budget_departments,department_name,' . $id,
            'description' => 'nullable|string|max:1000',
        ]);

        //update the department
        try{

            $department = budgetDepartment::where('school_id', 1)->findOrFail($id); //hardcoded school id for now
            $department->update([
                'department_name' => $validatedData['department_name'],
                'description' => $validatedData['description'] ?? null,
            ]);
        }catch(\Exception $e){
            //return back with error message
            return back()->withErrors(['error' => 'Failed to update department: ' . $e->getMessage()])->withInput();
        }

        //redirect back with success message
        return back()->with('success', 'Department updated successfully.');
    }


    //function to delete a department
    public function deletebudgetdepartment($id)
    {

        //delete the department
        try{

            $department = budgetDepartment::where('school_id', 1)->findOrFail($id); //hardcoded school id for now
            $department->delete();
            
        }catch(\Exception $e){
            //return back with error message
            return back()->withErrors(['error' => 'Failed to delete department: ' . $e->getMessage()])->withInput();
        }

        //redirect back with success message
        return back()->with('success', 'Department deleted successfully.');

    }


    //function to fetch the budget department data for a specific school

    protected function fetchbudgetdepartments($school_id)
    {
        //fetch all the budget departments from the database
        $departments = budgetDepartment::where('school_id', $school_id)->get();

        //get the total of departments
        $totalDepartments = $departments->count();

        return [
            'total' => $totalDepartments,
            'departments' => $departments,
        ];
    }

    //function to obtain the personal details of the logged in user
    protected function getUserDetails()
    {
        //get the user id 
        $userId = auth()->id();

        //get the teacher of the user
        $teacher = Teacher::where('user_id', $userId)->first();

        //get the school id of the teacher
        $school = $teacher->school_id;

        return [
            'school_id' => $school
        ];
    }

}
