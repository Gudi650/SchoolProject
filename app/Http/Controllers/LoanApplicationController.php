<?php

namespace App\Http\Controllers;

use App\Models\LoanApplication;
use App\Models\LoanConfigurations;
use App\Models\LoanType;
use App\Models\LoanSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanApplicationController extends Controller
{

    //function to show teacher loan proposals/progress page
    public function proposals()
    {
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'You must be logged in to view loan proposals.');
        }

        $schoolId = $user->school_id ?? $user->teachers()->value('school_id') ?? session('school_id');

        if (!$schoolId) {
            return back()->with('error', 'School information is missing for this account.');
        }

        // Fetch this user's loan applications and include loan type for display
        $loanApplications = LoanApplication::with('loanType')
            ->where('user_id', $user->id)
            ->where('school_id', $schoolId)
            ->latest()
            ->get();

        return view('TeacherPanel.loan.loanproposals', [
            'loanApplications' => $loanApplications,
        ]);
    }

    //function to show the loan application necessecities in the model
    function show()
    {
        $user = Auth::user();
        $schoolId = $user->school_id ?? $user->teachers()->value('school_id') ?? session('school_id');

        if (!$schoolId) {
            return back()->with('error', 'School information is missing for this account.');
        }

        $loanTypes = LoanType::where('school_id', $schoolId)->get() ?? 0;

        return view('TeacherPanel.loan.dashboard', [
            'loanTypes' => $loanTypes,
        ]);
    }



    //function to store the loan application to the db after the user submits the form
    public function store(Request $request)
    {
        // VALIDATE ALL USER INPUT
        $validated = $request->validate([
            'loan_type_id' => 'required|exists:loan_types,id',
            'amount' => 'required|numeric|min:1',
            'duration_months' => 'required|integer|min:1',
            'purpose' => 'nullable|string|max:2000',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // GET AUTHENTICATED USER
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'You must be logged in to apply for a loan.')->withInput();
        }

        // RESOLVE SCHOOL ID
        // Try user->school_id first, then check if user is a teacher and get from teacher table
        $schoolId = $user->school_id
            ?? $user->teachers()->value('school_id')
            ?? session('school_id');

        if (!$schoolId) {
            return back()->with('error', 'School information is missing for this account.')->withInput();
        }

        //SECURITY CHECK - FETCH LOAN TYPE WITH SCHOOL VALIDATION
        // This prevents users from applying for loan types from other schools
        $loanType = LoanType::where('id', $validated['loan_type_id'])
            ->where('school_id', $schoolId)
            ->firstOrFail();

        // Extract loan type details
        $interestRate = (float) $loanType->interest_rate;
        $amount = (float) $validated['amount'];
        $duration = (int) $validated['duration_months'];

        //GENERATE UNIQUE LOAN REFERENCE
        //Format: LN-20260402-ABC123
        do {
            $loanReference = 'LN-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (LoanApplication::where('loan_reference', $loanReference)->exists());

        // CALCULATE FINANCIAL DETAILS
        // Calculate how much interest the borrower will pay
        $totalInterest = round(($amount * $interestRate / 100) * ($duration / 12), 2);
        
        // Total amount to repay = Principal + Interest
        $totalRepayment = $amount + $totalInterest;
        
        // Calculate what the borrower pays each month
        $monthlyInstallment = round($totalRepayment / $duration, 2);

        // FETCH SCHOOL LOAN SETTINGS FOR PAYE CALCULATION
        // Settings contain the minimum interest rate (BOT rate) set by school
        $settings = LoanConfigurations::where('school_id', $schoolId)->first();

        $minRate = $settings->min_interest_rate ?? 5.75; // Fallback to 5.75% if not set

        //get user's salary for paye calculation
        $teacherz = $user->teachers()->first();
        $basicSalary = $teacherz ? $teacherz->payrollConfigurations()->value('base_salary') : 0;

        // DETERMINE IF PAYE (TAX BENEFIT) APPLIES
        // PAYE applies if either trigger condition is true:
        // Trigger A: Loan interest rate is BELOW the minimum rate (fringe benefit)
        // Trigger B: Loan amount is > 3x salary AND duration > 12 months (large loan)
        $payeTriggerA = $interestRate < $minRate;
        $payeTriggerB = ($amount > ($basicSalary * 3)) && ($duration > 12);
        $payeApplicable = $payeTriggerA || $payeTriggerB;

        // ✅ STEP 9: CALCULATE PAYE BENEFITS (if applicable)
        // PAYE benefit = Difference between minimum rate and actual rate
        if ($payeApplicable) {

            // Interest if loan were at minimum rate (what it could have been)
            $benefitInterest = ($amount * $minRate / 100);
            
            // Actual interest charged
            $actualInterest = ($amount * $interestRate / 100);
            
            // Annual benefit = the tax-free value difference
            //inside the abs ensure it gives out a positive value even if the actual interest is higher than the benefit interest
            $annualBenefit = abs($benefitInterest - $actualInterest);
           
            // Monthly benefit spread over 12 months
            $monthlyBenefit = $annualBenefit / 12;
            
            // Store benefits as positive value (safety net: max ensures no negative values)
            $payeBenefitAnnual = max(0, round($annualBenefit, 2));
            $payeBenefitMonthly = max(0, round($monthlyBenefit, 2));

        } else {
            $payeBenefitAnnual = null;
            $payeBenefitMonthly = null;
        }

        //HANDLE FILE ATTACHMENT (IF PROVIDED)
        $attachmentPath = $request->hasFile('attachment')
            ? $request->file('attachment')->store('loan-applications', 'public')
            : null;

        //SAVE LOAN APPLICATION TO DATABASE
        LoanApplication::create([
            // Reference & IDs
            'loan_reference' => $loanReference,
            'school_id' => $schoolId,
            'user_id' => $user->id,
            'loan_type_id' => $validated['loan_type_id'],

            // Basic Details
            'amount' => $amount,
            'duration_months' => $duration,
            'purpose' => $validated['purpose'] ?? null,
            'attachment' => $attachmentPath,

            // Financial Calculations
            'interest_rate' => $interestRate,
            'total_interest' => $totalInterest,
            'total_repayment' => $totalRepayment,
            'monthly_installment' => $monthlyInstallment,

            // PAYE (Tax Benefit) Details
            'paye_applicable' => $payeApplicable,
            'paye_benefit_annual' => $payeBenefitAnnual,
            'paye_benefit_monthly' => $payeBenefitMonthly,

            // Status (newly created applications start as pending)
            'status' => 'pending',
        ]);

        //RETURN SUCCESS MESSAGE
        return back()->with('success', 'Loan application submitted successfully.');
    }
}
