<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class feestructure extends Controller
{
    //

    //display the fee structure management page
    public function viewFeeStructure()
    {

        //get the details of the logged in user
        //$details = $this->getDetails();

        //get the classes from the details
        //$classes = $details['classes'];

        //dump
        //dd($details);

        //return and pass values to the view
        return view('AccountantPanel.fees.fee-structure' , [
            //'classes' => $classes,
        ]);
    }
    

    //save the fee structure
    public function savefeestructure(Request $request)
    {

        try
        {
            //validate the request
            $validated = $request->validate([
                'currency' => 'required|string|max:3',
                'tuition_fee' => 'required|numeric|min:0',
                'transport_fee' => 'nullable|numeric|min:0',
                'hostel_fee' => 'nullable|numeric|min:0',
                'library_fee' => 'nullable|numeric|min:0',
                'exam_fee' => 'nullable|numeric|min:0'
            ]);

            //dump the validated data
            dd($validated);

            //process the validated data
            //For example, save to database (not implemented here)

        }
        catch (\Exception $e)
        {
            return back()->withErrors(['error' => 'An error occurred while saving the fee structure: ' . $e->getMessage()]);

        }
        
        return back()->with('success', 'Fee Structure saved successfully');

    }

    //obtain the personal and school details of the logged in user
    protected function getDetails()
    {
        //get the user id 
        $userId = auth()->id();

        //get the teacher of the user
        $teacher = Teacher::where('user_id', $userId)->first();

        //get teh school of teh teacher
        $school = $teacher->schools;

        //get the classes of the school
        $classes = $school->classAvailables;


        return [
            'userId' => $userId,
            'teacher' => $teacher,
            'school' => $school,
            'classes' => $classes,
        ];

    }



}
