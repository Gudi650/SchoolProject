<?php

namespace App\Http\Controllers;

use App\Models\budget as ModelsBudget;
use App\Models\budgetCategories;
use App\Models\budgetDepartment;
use App\Models\BudgetAudit;
use App\Models\FinanceCategory;
use App\Models\Teacher;
use App\Services\AccountantContextService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class Budget extends Controller
{
    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    //function to show budget management page
    public function showBudgetManagement()
    {

        //get the personal details of the authenticated user
        //$userDetails = $this->getUserDetails();

        //get teh school id
        //$school_id = $userDetails['school_id'];

        $schoolId = $this->accountantContext->requireSchoolId();
        $departments = $this->fetchbudgetdepartments($schoolId);

        $previousBudgets = ModelsBudget::where('school_id', $schoolId)
            ->orderBy('created_at', 'desc')
            ->get();

        $editBudget = request('edit')
            ? ModelsBudget::with('categories')->where('school_id', $schoolId)->find(request('edit'))
            : null;

        $editCategories = $editBudget
            ? $editBudget->categories->map(fn ($c) => [
                'departmentId' => $c->department_id,
                'expenseType' => $c->expense_type,
                'amount' => (float) $c->amount,
            ])->values()->all()
            : [];

        return view('AccountantPanel.budget.createbudget',[
            'departments' => $departments,
            'previousBudgets' => $previousBudgets,
            'financeCategories' => FinanceCategory::namesFor($schoolId),
            'editBudget' => $editBudget,
            'editCategories' => $editCategories,
        ]);

    }

    //function to store budget data
    public function storeBudget(Request $request)
    {
        try {
            $schoolId = $this->accountantContext->requireSchoolId();
            $validatedData = $this->validatedBudget($request, $schoolId);

            //store the budget main data in the budgets table
            //also get the newly created budget id
            $budgetId = $this->storeBudgetData($validatedData, $schoolId);

            //process the validated data
            $categories = $validatedData['categories'];

            $this->storeBudgetCategories($budgetId, $categories);
            $this->audit($schoolId, $budgetId, 'created', ['after' => $validatedData]);

            return redirect()->route('accounting.createBudget')->with('success', 'Budget created successfully with ' . count($categories) . ' categories!');

        } catch (\Illuminate\Validation\ValidationException $e) {

            //if validation fails, redirect back with errors
            return redirect()->route('accounting.createBudget')->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {

            //handle any other exceptions
            return redirect()->route('accounting.createBudget')->with('error', 'Error creating budget: ' . $e->getMessage())->withInput();
            
        }

    }


    public function updateBudget(Request $request, int $id)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $budget = ModelsBudget::with('categories')->where('school_id', $schoolId)->findOrFail($id);

        try {
            $validatedData = $this->validatedBudget($request, $schoolId);
            $before = $this->snapshot($budget);

            DB::transaction(function () use ($budget, $validatedData) {
                $budget->update([
                    'budget_name' => $validatedData['budgetName'],
                    'start_date' => $validatedData['budgetStartDate'],
                    'end_date' => $validatedData['budgetEndDate'],
                    'total_amount' => $validatedData['totalBudget'],
                    'description' => $validatedData['description'] ?? null,
                ]);
                budgetCategories::where('budget_id', $budget->id)->delete();
                $this->storeBudgetCategories($budget->id, $validatedData['categories']);
            });

            $this->audit($schoolId, $budget->id, 'updated', ['before' => $before, 'after' => $validatedData]);

            return redirect()->route('accounting.budgetingManagement')->with('success', 'Budget updated.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('accounting.createBudget', ['edit' => $id])->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('accounting.createBudget', ['edit' => $id])->with('error', 'Error updating budget: ' . $e->getMessage())->withInput();
        }
    }

    public function destroyBudget(int $id)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $budget = ModelsBudget::with('categories')->where('school_id', $schoolId)->findOrFail($id);
        $this->audit($schoolId, $budget->id, 'deleted', ['before' => $this->snapshot($budget)]);
        $budget->delete();

        return redirect()->route('accounting.budgetingManagement')->with('success', 'Budget deleted.');
    }

    protected function validatedBudget(Request $request, int $schoolId): array
    {
        return $request->validate([
            'budgetName' => 'required|string|max:255',
            'totalBudget' => 'required|numeric|min:0.01',
            'budgetStartDate' => 'required|date',
            'budgetEndDate' => 'required|date|after_or_equal:budgetStartDate',
            'description' => 'nullable|string|max:1000',
            'categories' => 'required|array|min:1',
            'categories.*.departmentId' => 'required|exists:budget_departments,id,school_id,' . $schoolId,
            'categories.*.expenseType' => ['required', 'string', 'max:64', Rule::in(FinanceCategory::namesFor($schoolId)->all())],
            'categories.*.amount' => 'required|numeric|min:0.01',
        ]);
    }

    protected function snapshot(ModelsBudget $budget): array
    {
        return [
            'budget_name' => $budget->budget_name,
            'start_date' => $budget->start_date,
            'end_date' => $budget->end_date,
            'total_amount' => $budget->total_amount,
            'description' => $budget->description,
            'categories' => $budget->categories->map(fn ($c) => [
                'department_id' => $c->department_id,
                'expense_type' => $c->expense_type,
                'amount' => $c->amount,
            ])->values()->all(),
        ];
    }

    protected function audit(int $schoolId, ?int $budgetId, string $action, array $changes): void
    {
        BudgetAudit::create([
            'school_id' => $schoolId,
            'budget_id' => $budgetId,
            'user_id' => Auth::id(),
            'action' => $action,
            'changes' => $changes,
        ]);
    }

    //function to store budget data in the table in the database
    protected function storeBudgetData($budgetData, int $schoolId)
    {
        //since the data passed wil already be validated
        //store the budget data in the budgets table
        try {
            $budget = ModelsBudget::create([
                'school_id' => $schoolId,
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
