<?php

namespace App\Http\Controllers;

use App\Models\budget as ModelsBudget;
use App\Models\budgetCategories;
use App\Models\budgetDepartment;
use App\Models\Teacher;
use Illuminate\Http\Request;

class Budget extends Controller
{
    
    //function to show budget management page
    public function showBudgetManagement()
    {

        //get the personal details of the authenticated user
        //$userDetails = $this->getUserDetails();

        //get teh school id
        //$school_id = $userDetails['school_id'];

        /*
        use the school id to fetch budget departments
        but now hard coded school_id for testing purposes only
        school_id = 1
        */

        //now call the fetch department function to get the departments
        $departments = $this->fetchbudgetdepartments(1); //hardcoded for now

        //fetch previous budgets for copying (from last year or earlier)
        $previousBudgets = ModelsBudget::orderBy('created_at', 'desc')->get();

        //return the view and pass the departments and previous budgets data
        return view('AccountantPanel.budget.createbudget',[
            'departments' => $departments,
            'previousBudgets' => $previousBudgets,
        ]);

    }

    //function to store budget data
    public function storeBudget(Request $request)
    {
        try {
            //validate the request data - field names must match form input names
            $validatedData = $request->validate([
                'budgetName' => 'required|string|max:255',
                'totalBudget' => 'required|numeric|min:0.01',
                'budgetStartDate' => 'required|date',
                'budgetEndDate' => 'required|date|after_or_equal:budgetStartDate',
                'description' => 'nullable|string|max:1000',
                'categories' => 'required|array|min:1',
                'categories.*.departmentId' => 'required|exists:budget_departments,id',
                'categories.*.expenseType' => 'required|string|max:255',
                'categories.*.amount' => 'required|numeric|min:0.01',
            ]);

            //store the budget main data in the budgets table
            //also get the newly created budget id
            $budgetId = $this->storeBudgetData($validatedData);

            //process the validated data
            $categories = $validatedData['categories'];

            //store the budget categories data
            $this->storeBudgetCategories($budgetId, $categories);
            
            //redirect to the create budget page with success message
            return redirect()->route('accounting.createBudget')->with('success', 'Budget created successfully with ' . count($categories) . ' categories!');

        } catch (\Illuminate\Validation\ValidationException $e) {

            //if validation fails, redirect back with errors
            return redirect()->route('accounting.createBudget')->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {

            //handle any other exceptions
            return redirect()->route('accounting.createBudget')->with('error', 'Error creating budget: ' . $e->getMessage())->withInput();
            
        }

    }


    //function to store budget data in the table in the database
    protected function storeBudgetData($budgetData)
    {
        //since the data passed wil already be validated
        //store the budget data in the budgets table
        try {
            $budget = ModelsBudget::create([
                'school_id' => 1, //hardcoded for now
                'budget_name' => $budgetData['budgetName'],
                'start_date' => $budgetData['budgetStartDate'],
                'end_date' => $budgetData['budgetEndDate'],
                'total_amount' => $budgetData['totalBudget'],
                'description' => $budgetData['description'] ?? null,
            ]);

            //return the newly created budget id
            return $budget->id;

        } catch (\Exception $e) {
            //handle exception if any
            throw new \Exception('Error storing budget data: ' . $e->getMessage());
        }
    }

    //function to store budget categories
    protected function storeBudgetCategories($budgetId, $categories)
    {
        try{

            //loop through each category and store in database
            foreach ($categories as $category) {
                
                //store each category logic here
                $budgetCategory = budgetCategories::create([
                    'budget_id' => $budgetId,
                    'department_id' => $category['departmentId'],
                    'expense_type' => $category['expenseType'],
                    'amount' => $category['amount'],
                ]);

            }

            return true;

        }
        catch (\Exception $e) {
            //handle exception if any
            throw new \Exception('Error storing budgetCategory data: ' . $e->getMessage());
        }

        

    }



    //function to fetch departments for a specific school
    protected function fetchbudgetdepartments($school_id)
    {
        //fetch all the budget departments from the database
        $departments = budgetDepartment::where('school_id', $school_id)->get();

        //return departments
        return $departments;   
    }

    //function to get the personal details of the authenticated user
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
