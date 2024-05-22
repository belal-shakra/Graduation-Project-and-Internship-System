<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->only(['create']);
    }


    public function create(){

        return view('student.login');
    }


    public function home(Request $request){

        $student_username = Auth::user()->username;
        return view('student.home', compact('student_username'));
    }
}
