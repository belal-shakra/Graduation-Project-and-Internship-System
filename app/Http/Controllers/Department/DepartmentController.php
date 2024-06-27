<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDashboardRequest;
use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->only(['create']);
    }


    /**
     * Display the login form for department's head.
     */
    public function create(){
        return view('department.login');
    }



    /**
     * Display a form for graduation project and internship info of the department,
     * and some statistics about department's students.
     */
    public function home(){

        $department = Department::find(Auth::user()->department_id);
        $student_type_id = UserType::firstWhere('name', 'student')->id;
        $student_ids = User::where('department_id', Auth::user()->department_id)
                            ->where('user_type_id', $student_type_id)->get('id');


        $all_stus = count($student_ids);
        $exceed90 = 0;
        $in_gp = 0;
        $in_int = 0;
        $expectTG = 0;
        foreach($student_ids as $id){
            $student = Student::firstWhere('user_id', $id->id);

            if($student->hour >= 90){
                $exceed90++;
                
                if($student->in_graduation_project)
                    $in_gp++;

                if($student->in_internship)
                    $in_int++;

                if(132 - $student->hour <= 15)
                    $expectTG++;
            }
        }


        return view('department.dashboard', compact(['department' ,'all_stus', 'exceed90', 'in_gp', 'in_int', 'expectTG']));
    }


    /**
     * Store a graduation project and internship info of the department.
     */
    public function store(StoreDashboardRequest $request, Department $department){
        $department->update($request->validated());
        return back();
    }
}
