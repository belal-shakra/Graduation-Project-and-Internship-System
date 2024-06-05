<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentInternshipController extends Controller
{
    public function index(){


        $student_type_id = UserType::firstWhere('name', 'student')->id;
        $department_student_users = User::where('department_id', Auth::user()->department_id)
        ->where('user_type_id', $student_type_id)->get();
        
        
        $in_int_students = [];
        foreach($department_student_users as $student_user){
            $is_in_int = Student::firstWhere('user_id', $student_user->id)->in_internship;

            if($is_in_int)
                array_push($in_int_students, $student_user);
        }


        $supervisor_type_id = UserType::firstWhere('name', 'supervisor')->id;
        $head_type_id = UserType::firstWhere('name', 'supervisor&head')->id;
        $department_supervisors = User::where('department_id', Auth::user()->department_id)
        ->where('user_type_id', $supervisor_type_id)->get(['id', 'first_name', 'last_name']);

        $department_supervisors = $department_supervisors->merge([Auth::user()]);


        return view('department.Internship.in-internship', compact(['in_int_students', 'department_supervisors']));
    }



    public function store(Request $request){

        dd($request);
    }



    public function show(User $student_user){


        return view('department.Internship.report');
    }
}
