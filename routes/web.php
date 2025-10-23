<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParentregistrationController;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;


//create middleware to the routes that require authentication
Route::middleware('auth')->group(function () {

    Route::get('/', [Student::class, 'index'])->name('student.homepage');

    Route::get('/student-panel/exams-results', function () {
        return view('StudentPanel.exams-results');
    })->name('student.exams');

    Route::view('/student-panel/timetable', 'StudentPanel.timetable')->name('student.timetable');

    Route::view('/student-panel/library', 'StudentPanel.library')->name('student.library');

    Route::view('/student-panel/feespayment', 'StudentPanel.feespayment')->name('student.feespayment');

    Route::view('/student-panel/announcements', 'StudentPanel.announcements')->name('student.announcements');

    Route::view('/student-panel/assignments', 'StudentPanel.assignment')->name('student.assignments');

    Route::view('/student-panel/attendance/checkin', 'StudentPanel.attendance.checkin')->name('student.attendance.checkin');

    Route::view('/student-panel/attendance/attendancereport', 'StudentPanel.attendance.attendancereport')->name('student.attendance.report');



    //routes to handle student and parent registrations submissions
    Route::post('/studentregistration', [ParentregistrationController::class, 'StudentRegistration'])->name('studentregistration');

    Route::post('/parentregistration', [ParentregistrationController::class, 'ParentRegistration'])->name('parentregistration');

    //logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});



//middleware for routes that do not require authentication
Route::middleware('guest')->controller(AuthController::class)->group(function(){

    //routes showing the login and signup forms
    Route::get('/login', 'showLogin')->name('showlogin');
    Route::get('/signup', 'showSignUp')->name('showsignup');

});


Route::get('/parentregistration',[ParentregistrationController::class , 'showParentRegistration'])->name('showparentregistration');

Route::get('/studentregistration',[ParentregistrationController::class , 'showStudentRegistration'])->name('showstudentregistration');


//routes handling login and signup form submissions
Route::post('/login', [AuthController::class , 'login'])->name('login');
Route::post('/signup', [AuthController::class , 'signup'])->name('signup');