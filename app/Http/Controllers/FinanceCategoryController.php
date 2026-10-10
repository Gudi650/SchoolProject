<?php

namespace App\Http\Controllers;

use App\Models\FinanceCategory;
use App\Services\AccountantContextService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FinanceCategoryController extends Controller
{
    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    public function index()
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $categories = FinanceCategory::where('school_id', $schoolId)->orderBy('name')->get();

        return view('AccountantPanel.vendors.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:64',
                Rule::unique('finance_categories', 'name')->where('school_id', $schoolId),
            ],
        ]);

        FinanceCategory::remember($schoolId, $data['name']);

        return redirect()->route('accounting.financeCategories')->with('success', 'Category added.');
    }

    public function update(Request $request, int $category)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $row = FinanceCategory::where('school_id', $schoolId)->findOrFail($category);
        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:64',
                Rule::unique('finance_categories', 'name')->where('school_id', $schoolId)->ignore($row->id),
            ],
        ]);

        $row->update(['name' => trim($data['name'])]);

        return redirect()->route('accounting.financeCategories')->with('success', 'Category updated.');
    }

    public function destroy(int $category)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        FinanceCategory::where('school_id', $schoolId)->findOrFail($category)->delete();

        return redirect()->route('accounting.financeCategories')->with('success', 'Category deleted.');
    }
}
