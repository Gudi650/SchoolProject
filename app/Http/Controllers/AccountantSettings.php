<?php

namespace App\Http\Controllers;

use App\Models\NSSFPSSF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccountantSettings extends Controller
{
    //show
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


    //function to save health insuranc settings
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
            'range_lower_bound.*' => 'nullable|numeric|min:0',
            'range_upper_bound' => 'nullable|array',
            'range_upper_bound.*' => 'nullable|numeric|min:0',
            'range_employer_contribution' => 'nullable|array',
            'range_employer_contribution.*' => 'nullable|numeric|min:0',
            'range_employee_contribution' => 'nullable|array',
            'range_employee_contribution.*' => 'nullable|numeric|min:0',
        ]);

        //dump the validated data
        dd($validated);

        /**
         * Check if health insurance is the other selection from the dropdown ,if so, then we have to get the other insurance provider name from the form and save it to the database
         * We also need to check if the contribution type is percentage or fixed amount and save that to the database as well.
         * If its percentage we save them as decimal so as its ready to use later on ed 20% -> 0.2
         * We will also need to save the contribution percentage or fixed amount to the database as well depending on the contribution type selected.
         */


        //save the health insurance settings to the database
        // For simplicity, we will just save these settings in the same NSSFPSSF model, but in a real application, you might want to have a separate model for health insurance settings.

        NSSFPSSF::updateOrCreate(
            ['school_id' => 1], // Again, the school_id is hardcoded for now
            [
                'health_insurance_enabled' => $validated['health_insurance_enabled'],
                'health_insurance_provider' => $validated['health_insurance_provider'],
                'health_insurance_contribution' => $validated['health_insurance_contribution'],
            ]
        );

        //redirect back with success message
        return redirect()->route('accounting.settings')->with('success', 'Health insurance settings updated successfully.');
    }

}
