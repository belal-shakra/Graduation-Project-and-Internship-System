<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\GraduationProject;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentGraduationProjectController extends Controller
{

    /**
     * Display the students that exceeds 90 hours.
     */ 
    public function exceed90(){

        $students = Student::whereHas('user', function($query){
            $query->where('department_id', Auth::user()->department_id);
        })->where('hour','>=', '90')->get();

    return view('department.Graduation-Project.exceed-90', compact('students'));
    }



    /**
     * Display teams that belongs to the department.
     */
    public function teams(){

        $teams = GraduationProject::where('department_id', Auth::user()->department_id)->get();
        return view('department.Graduation-Project.teams', compact('teams'));
    }



    /**
     * Show the details of specific team.
     */
    public function team_details(GraduationProject $graduation_project){

        if($graduation_project->department_id != Auth::user()->department_id)
            return to_route('department.teams');
        
        $gp = $graduation_project;
        return view('department.Graduation-Project.team-details', compact(['gp']));
    }
}
