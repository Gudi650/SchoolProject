<?php

namespace App\Http\Controllers;

use App\Models\FeeStructure as ModelsFeeStructure;
use App\Models\Teacher;
use Illuminate\Http\Request;

class feestructure extends Controller
{
    //

    //display the fee structure management page
    public function viewFeeStructure()
    {

        //get the details of the logged in user
        //$details = $this->getUserDetails();

        //get the classes from the details
        //$classes = $details['classes'];

        //dump
        //dd($details);

        //get the fee structures of the school
        //$feeStructures = $this->getFeeStructures($details['school']->id);

        //get the custom fee structures for specific classes
        //$customFeeStructures = $this->getCustomFeeStructures($details['school']->id);


        /*
            THIS HAS TO BE CHANGED LATER TO DYNAMIC SCHOOL ID
            AS THIS IS NOT VALID LATER ON WHEN MULTI SCHOOL IS IMPLEMENTED

        */


        //temporarily require the data
        $feeStructures = $this->getFeeStructures(1); 
        $customFeeStructures = $this->getCustomFeeStructures(1);



        //create variable to add the total of the fees
        $totalFees = 0;


        //return and pass values to the view
        return view('AccountantPanel.fees.fee-structure' , [
            //'classes' => $classes,
            'feeStructures' => $feeStructures,
            'customFeeStructures' => $customFeeStructures,
            'totalFees' => $totalFees,
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
                'exam_fee' => 'nullable|numeric|min:0',
                'classes' => 'nullable|array',
                'classes.*' => 'integer|max:50',

                //custom fee components can be added here as an array
                'all_components' => 'nullable|array',
                'all_components.*.name' => 'required_with:all_components|string|max:100',
                'all_components.*.amount' => 'required_with:all_components|numeric|min:0',
                
                'specific_components' => 'nullable|array',
                'specific_components.*.name' => 'required_with:specific_components|string|max:100',
                'specific_components.*.amount' => 'required_with:specific_components|numeric|min:0',
            
                //for specific scope
                'school_id' => 'nullable|integer|exists:schools,id',


            ]);

            $classes = $request->input('classes');
            $validated['class_id'] = (!empty($classes) && is_array($classes)) ? implode(',', $classes) : null;
            $validated['all_components'] = $request->input('all_components'); // null when missing
            $validated['specific_components'] = $request->input('specific_components'); // null when missing
            $validated['for'] = $validated['class_id'] !== null ? 'specific' : 'general';

            //add a default school id if not provided
            if (empty($validated['school_id']))
            {
                $validated['school_id'] = '1';
            }

            //dump the validated data
            //dd($validated);

            //process the validated data
            //For example, save to database (not implemented here)

            try{

                //create and save validated data to the database

                //now check if there are custom components to be added
                //if so then do the below create operation and if not then create without dynamic attributes

                if (empty($validated['all_components']) && empty($validated['specific_components']) )
                {
                    //create without dynamic attributes
                    ModelsFeeStructure::create($validated);

                    return back()->with('success', 'Fee Structure saved successfully');
                }
                elseif($validated['all_components'] && empty($validated['specific_components']))
                {

                    //create with dynamic attributes
                    ModelsFeeStructure::create(array_merge(
                        $validated,
                        [
                            'dynamic_attributes' => [
                                'all_components' => $validated['all_components'],
                            ],
                        ]
                    ));
                }elseif(empty($validated['all_components']) && $validated['specific_components'])
                {
                    //create with dynamic attributes
                ModelsFeeStructure::create(array_merge(
                    $validated,
                    [
                        'dynamic_attributes' => [
                            'all_components' => $validated['all_components'],
                            'specific_components' => $validated['specific_components'],
                        ],
                    ]
                ));
                }

            }catch(\Exception $e)
            {
               return back()->withErrors(['error' => 'Database error: ' . $e->getMessage()]);
                
                /*
                throw $e;
                dd($e->getMessage()); 
                */
            }
            


        }
        catch (\Exception $e)
        {
           return back()->withErrors(['error' => 'An error occurred while saving the fee structure: ' . $e->getMessage()]);
            
            /*
            throw $e;
            dd($e->getMessage()); 
            */
        }
        
        return back()->with('success', 'Fee Structure saved successfully');

    }

    //obtain the personal and school details of the logged in user
    protected function getUserDetails()
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

    //get the fee structures of a school
    protected function getFeeStructures($schoolId)
    {

        //get the fee structures of the school
        $feeStructures = ModelsFeeStructure::where('school_id', $schoolId)
                            ->where('for', 'general')
                            ->get();

        //return the fee structures
        return $feeStructures;

    }

    //get the fee structures for specific classes
    protected function getCustomFeeStructures($schoolId)
    {

        //get the fee structures of the school
        $customFeeStructures = ModelsFeeStructure::where('school_id', $schoolId)
                            ->where('for', 'specific')
                            ->get();

        //return the fee structures
        return $customFeeStructures;

    }



}
