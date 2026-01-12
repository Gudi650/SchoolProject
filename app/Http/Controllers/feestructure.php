<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class feestructure extends Controller
{
    //

    //display the fee structure management page
    public function viewFeeStructure()
    {
        return view('AccountantPanel.fees.fee-structure');
    }
    

    //save the fee structure
    public function savefeestructure()
    {

        //dump
        dd('I am in save fee structure');

        return back()->with('success', 'Fee Structure saved successfully');

    }



}
