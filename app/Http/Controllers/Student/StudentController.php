<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->only(['create']);
    }


    /**
     * Display studnet's login form.
     */
    public function create(){

        return view('student.login');
    }


    /**
     * Display Student's home page.
     */
    public function home(){

        return view('student.home');
    }
}
