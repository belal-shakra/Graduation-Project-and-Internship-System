<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\InternshipCompany;
use App\Models\InternshipCourse;
use App\Models\Notification;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentInternshipController extends Controller
{
    public function index(){

        $students = Student::whereHas('user', function($query){
            $query->where('department_id', Auth::user()->department_id);
        })->where('in_internship', '1')->get();


        $supervisors = Supervisor::whereHas('user', function($query){
            $query->where('department_id', Auth::user()->department_id);
        })->get();

        $week = Auth::user()->department->week;

        return view('department.Internship.in-internship', compact(['students', 'supervisors', 'week']));
    }



    public function store(Request $request){


        $students = Student::whereHas('user', function($query){
            $query->where('department_id', Auth::user()->department_id);
        })->where('in_internship', '1')->get();


        foreach($students as $student){

            if(isset($request[$student->user->university_id])){
                $user = User::firstWhere('university_id', $request[$student->user->university_id]);
                if($user){
                    $supervisor = Supervisor::firstWhere('user_id', $user->id);
                    $student->supervisor_id = $supervisor->id;
                    $student->save();



                    $supervisor_name = $supervisor->user->first_name .' '. $supervisor->user->last_name;
                    $student_name = $student->user->first_name .' '. $student->user->last_name;
                    Notification::create([
                        'title'   => 'Internship Supervision',
                        'message' => 'Your Internship Supervisor is '.$supervisor_name,
                        'type' => 'student',
                        'is_read' => false,
                        'user_id' => $student->user->id,
                    ]);

                    Notification::create([
                        'title'   => 'Internship Supervision',
                        'message' => 'You are Internship Supervisor for '.$student_name,
                        'type' => 'supervisor',
                        'is_read' => false,
                        'user_id' => $supervisor->user->id,
                    ]);

                }
                else
                    continue;
                
            }
        }
    
        return back();
    }



    public function show(Student $student_rec){
        $student = $student_rec;

        if($student->user->department_id != Auth::user()->department_id || !$student->in_internship)
            return to_route('department.in_int');

        return view('department.Internship.report', compact(['student']));
    }
}
