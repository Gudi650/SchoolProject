<?php

namespace App\Http\Controllers;

use App\Models\HealthInsurance;
use App\Models\LoanConfigurations;
use App\Models\LoanType;
use App\Models\NSSFPSSF;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AccountantSettings extends Controller
{
    //show the setting page
    public function showSettings()
    {
        return view('AccountantPanel.settings');
    }

    //save the PSSFNSSF settings
    public function saveContributions(Request $request)
    {

        //validate the request
        $validated = $request->validate([
            'nssf_contribution' => 'decimal:2|min:0|max:100',
            'psssf_contribution' => 'decimal:2|min:0|max:100',
            'contribution_type' => 'required|string',
            'school_contribution' => 'nullable|numeric|min:0',

        ]);

        /**
         * Note: The 'contribution_type' field is expected to be either 'nssf' or 'psssf' based on the checkbox input.
         * The system will need to ensure that only one of these can be active at a time
         * The system should also take the contibution percentage basing on the contribution type selected and save 
         * Now we will filter the data to save only the relevant contribution type and percentage to the database
         */

        // Filter the validated data to only include the relevant contribution type and percentage
        if ($validated['contribution_type'] === 'nssf') {
            $contributionData = [
                'nssf_contribution' => ($validated['nssf_contribution']/ 100),
                'contribution_type' => 'nssf',
                'psssf_contribution' => 0, // Set PSSF contribution to 0 if NSSF is selected
            ];
        } elseif ($validated['contribution_type'] === 'psssf') {
            $contributionData = [
                'nssf_contribution' => 0, // Set NSSF contribution to 0 if PSSF is selected
                'psssf_contribution' => ($validated['psssf_contribution']/ 100),
                'contribution_type' => 'psssf',
            ];
        } else {
            // Handle the case where an invalid contribution type is provided
            return redirect()->route('accounting.settings')->with('error', 'Invalid contribution type selected.');
        }

        /**
         * Check which contribution type is selected and save the corresponding contribution percentage to the database.
         */

        $updatedData = $contributionData['contribution_type'] === 'nssf' ? [
            'nssf_contribution' => $contributionData['nssf_contribution'],
            'contribution_type' => 'nssf',
        ] : [
            'psssf_contribution' => $contributionData['psssf_contribution'],
            'contribution_type' => 'psssf',
        ];

        NSSFPSSF::updateOrCreate(
            /**
             * The school_id is hardcoded to 1 for now, but in a real application, you would want to get this from the authenticated user's school or from the session.
             */
            ['school_id' => 1], 
            //add th relevant data (contribution type and respsctive percentages as well)
            $updatedData
        );

        //redirect back with success message
        return redirect()->route('accounting.settings')->with('success', 'Contributions updated successfully.');
    }


    //function to save health insurance settings
    public function saveHealthInsuranceSettings(Request $request)
    {

        //log all incoming request data
        Log::info('Health Insurance Request:', $request->all());

        //validate the request
        $validated = $request->validate([
            'health_insurance_provider' => 'nullable|string|max:255',
            'employer_contribution' => 'nullable|numeric|min:0',
            'employee_contribution' => 'nullable|numeric|min:0',
            'other_insurance_provider' => 'nullable|string|max:255',
            'contribution_type' => 'nullable|string|in:percentage,fixed',
            'insurance_has_ranges_hidden' => 'nullable|string|in:yes,no',
            'range_lower_bound' => 'nullable|array',
            'range_lower_bound.*' => 'nullable|numeric|min:0|max:999999.99',
            'range_upper_bound' => 'nullable|array',
            'range_upper_bound.*' => 'nullable|numeric|min:0|max:999999.99',
            'range_employer_contribution' => 'nullable|array',
            'range_employer_contribution.*' => 'nullable|numeric|min:0',
            'range_employee_contribution' => 'nullable|array',
            'range_employee_contribution.*' => 'nullable|numeric|min:0',
        ], [
            'range_lower_bound.*.max' => 'Lower bound must not exceed 999,999.99.',
            'range_upper_bound.*.max' => 'Upper bound must not exceed 999,999.99.',
        ]);


        /**
         * Check if health insurance is the other selection from the dropdown ,if so, then we have to get the other insurance provider name from the form and save it to the database
         * We also need to check if the contribution type is percentage or fixed amount and save that to the database as well.
         * If its percentage we save them as decimal so as its ready to use later on eg 20% -> 0.2
         * We will also need to save the contribution percentage or fixed amount to the database as well depending on the contribution type selected.
        */

        //1. check if the health insurance provider is the other selection from the dropdown or not
        $provider = $validated['health_insurance_provider'] ?? null;
        $providerName = $provider === 'other'
            ? ($validated['other_insurance_provider'] ?? null)
            : $provider;

        //2. check the contribution type and save the respective contribution values to the database
        $contributionType = $validated['contribution_type'] ?? 'percentage';
        $rawEmployeeContribution = $validated['employee_contribution'] ?? null;
        $rawEmployerContribution = $validated['employer_contribution'] ?? null;

        //employee contribution
        $employeeContribution = $contributionType === 'percentage' && $rawEmployeeContribution !== null
            ? ($rawEmployeeContribution / 100)
            : $rawEmployeeContribution;

        //employer contribution
        $employerContribution = $contributionType === 'percentage' && $rawEmployerContribution !== null
            ? ($rawEmployerContribution / 100)
            : $rawEmployerContribution;

        //mow save the range employee and employer contributions as well if the insurance has ranges
        $rangeEmployeeContributions = [];
        $rangeEmployerContributions = [];

        if (($validated['insurance_has_ranges_hidden'] ?? 'no') === 'yes') {
            $rangeEmployeeContributions = array_map(function ($contribution) use ($validated) {
                return $validated['contribution_type'] === 'percentage' ? ($contribution / 100) : $contribution;
            }, $validated['range_employee_contribution'] ?? []);
            $rangeEmployerContributions = array_map(function ($contribution) use ($validated) {
                return $validated['contribution_type'] === 'percentage' ? ($contribution / 100) : $contribution;
            }, $validated['range_employer_contribution'] ?? []);
        }

        try {
            //3. save the health insurance settings to the database
            $healthInsurance = HealthInsurance::updateOrCreate(
                ['school_id' => 1], // In a real application, you would get this from the authenticated user's school or from the session
                [
                    'provider_name' => $providerName,
                    'type' => $contributionType, // default to percentage if not provided
                    'employee_contribution' => $employeeContribution ?? 0,
                    'employer_contribution' => $employerContribution ?? 0,
                    'has_ranges' => ($validated['insurance_has_ranges_hidden'] ?? 'no') === 'yes',
                ]
            );

            //if the insurance has ranges, then we need to save the ranges to the database as well
            if ($healthInsurance->has_ranges && isset($validated['range_lower_bound'], $validated['range_upper_bound'], $validated['range_employee_contribution'], $validated['range_employer_contribution'])) {
                $rangesData = [];
                for ($i = 0; $i < count($validated['range_lower_bound']); $i++) {
                    $rangesData[] = [
                        'health_insurance_id' => $healthInsurance->id,
                        'lower_bound' => $validated['range_lower_bound'][$i],
                        'upper_bound' => $validated['range_upper_bound'][$i],
                        'employee_contribution' => $rangeEmployeeContributions[$i] ?? 0,
                        'employer_contribution' => $rangeEmployerContributions[$i] ?? 0,
                    ];
                }
                // Now we will insert the ranges data to the database using Eloquent's createMany method
                $healthInsurance->ranges()->createMany($rangesData);
            }
        } catch (QueryException $exception) {
            Log::error('Health insurance save failed (database)', [
                'message' => $exception->getMessage(),
                'request' => $request->all(),
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['health_insurance' => 'Could not save health insurance settings. Please check that all rate range amounts are valid and within the allowed limits.'])
                ->with('error', 'Could not save health insurance settings. Please review your inputs and try again.');
        } catch (\Throwable $exception) {
            Log::error('Health insurance save failed (unexpected)', [
                'message' => $exception->getMessage(),
                'request' => $request->all(),
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['health_insurance' => 'An unexpected error occurred while saving health insurance settings. Please try again.'])
                ->with('error', 'An unexpected error occurred while saving health insurance settings.');
        }


        
        //redirect back with success message
        return redirect()->route('accounting.settings')->with('success', 'Health insurance settings updated successfully.');
    }

    

    //function to save the Loan configurations
    public function saveLoanSettings(Request $request)
    {

        // Validate the request
        $validated = $request->validate([
            // GENERAL
            'max_loan_multiplier' => 'required|numeric|min:1|max:10',
            'max_loan_amount' => 'nullable|numeric|min:0',
            'max_duration_months' => 'required|integer|min:1|max:60',
            'grace_period_days' => 'required|integer|min:0|max:365',

            // INTEREST
            'default_interest_rate' => 'required|numeric|min:0|max:100',
            'min_interest_rate' => 'required|numeric|min:0|max:100',
            'interest_type' => 'required|in:flat,reducing',

            // REPAYMENT
            'max_deduction_percent' => 'required|numeric|min:1|max:100',
            'allow_early_repayment' => 'boolean',
            'allow_multiple_loans' => 'boolean',
            'auto_payroll_deduction' => 'boolean',

            // PAYE
            'enable_paye_calculation' => 'boolean',
            'warn_high_loan' => 'boolean',
            'warn_long_duration' => 'boolean',

            // APPROVAL
            'require_approval' => 'boolean',
            'approval_levels' => 'required|integer|min:1|max:5',
            'allow_override' => 'boolean',

            // NOTIFICATIONS
            'notify_on_approval' => 'boolean',
            'notify_on_deduction' => 'boolean',
            'notify_on_completion' => 'boolean',
        ]);

        // Handle checkboxes and convert them to boolean values
        $validated['allow_early_repayment'] = $request->has('allow_early_repayment');
        $validated['allow_multiple_loans'] = $request->has('allow_multiple_loans');
        $validated['auto_payroll_deduction'] = $request->has('auto_payroll_deduction');
        $validated['enable_paye_calculation'] = $request->has('enable_paye_calculation');
        $validated['warn_high_loan'] = $request->has('warn_high_loan');
        $validated['warn_long_duration'] = $request->has('warn_long_duration');
        $validated['require_approval'] = $request->has('require_approval');
        $validated['allow_override'] = $request->has('allow_override');
        $validated['notify_on_approval'] = $request->has('notify_on_approval');
        $validated['notify_on_deduction'] = $request->has('notify_on_deduction');
        $validated['notify_on_completion'] = $request->has('notify_on_completion');

        // Get the school_id from the authenticated user or session (replace with your actual logic)
        $schoolId = auth()->user()->school_id ?? 1;
        $validated['school_id'] = $schoolId;

        try {
            // Save or update the loan configuration for the school
            $loanConfig = LoanConfigurations::updateOrCreate(
                ['school_id' => $schoolId],
                $validated
            );
        } catch (\Illuminate\Database\QueryException $exception) {
            Log::error('Loan settings save failed (database)', [
                'message' => $exception->getMessage(),
                'request' => $request->all(),
            ]);

            return redirect()->back()
                ->withErrors(['loan_settings' => 'An unexpected error occurred while saving loan settings. Please try again.'])
                ->with('error', 'An unexpected error occurred while saving loan settings.');
        }

        // Save loan types
        if ($request->has('loan_types') && is_array($request->loan_types)) {
            $loanTypeIds = [];
            foreach ($request->loan_types as $typeData) {
                // Validate each loan type (add more rules as needed)
                $typeValidated = validator($typeData, [
                    'id' => 'nullable|integer|exists:loan_types,id',
                    'name' => 'required|string|max:100',
                    'max_amount' => 'required|numeric|min:0',
                    'interest_rate' => 'required|numeric|min:0|max:100',
                    'duration_months' => 'required|integer|min:1|max:60',
                    'status' => 'required|in:active,inactive',
                ])->validate();

                $typeValidated['school_id'] = $schoolId;

                // Update or create each loan type
                $loanType = LoanType::updateOrCreate(
                    ['id' => $typeValidated['id'] ?? null, 'school_id' => $schoolId],
                    $typeValidated
                );
                $loanTypeIds[] = $loanType->id;
            }

            // Optionally, delete loan types that were removed in the UI
            LoanType::where('school_id', $schoolId)
                ->whereNotIn('id', $loanTypeIds)
                ->delete();
        }

        // Redirect back with success message
        return redirect()->route('accounting.settings')->with('success', 'Loan settings updated successfully.');
    }
}

