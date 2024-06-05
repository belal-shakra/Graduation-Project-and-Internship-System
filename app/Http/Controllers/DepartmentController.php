<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->only(['create']);
    }


    public function create(){
        return view('department.login');
    }



    public function home(){
        return view('department.dashboard');
    }
}
