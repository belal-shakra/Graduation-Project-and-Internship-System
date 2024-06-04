<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->only(['create']);
    }


    public function create(){

        return view('supervisor.login');
    }


    public function home(Request $request){

        return view('supervisor.home');
    }
}
