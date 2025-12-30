<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    
    //the view function for announcements page
    public function viewAnnouncements()
    {
        return view('TeacherPanel.announcements');
    }



}
