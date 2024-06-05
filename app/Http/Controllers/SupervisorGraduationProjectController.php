<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use App\Models\GraduationProject;
use Illuminate\Support\Facades\Auth;

class SupervisorGraduationProjectController extends Controller
{
    private $project;
    private $students;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $supervisor_gp_id = Supervisor::firstWhere('user_id', Auth::user()->id)->graduation_project_id;
            $this->project = GraduationProject::find($supervisor_gp_id);
            $this->students = Student::where('graduation_project_id', $supervisor_gp_id)->get();

            return $next($request);
        });
    }


    public function all_teams(){
        $project = $this->project;
        $students = $this->students;

        return view('supervisor.Graduation-Project.teams', compact(['project', 'students']));
    }



    public function show(){
        $project = $this->project;
        $students = $this->students;

        return view('supervisor.Graduation-Project.team-details', compact(['project', 'students']));
    }
}
