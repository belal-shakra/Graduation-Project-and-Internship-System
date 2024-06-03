<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    public function index(){

        $student = Student::find(Auth::user()->id);
        if(!$student->graduation_project_id)
            return back();

        


        return view('student.Graduation-Project.timeline');
    }
}
