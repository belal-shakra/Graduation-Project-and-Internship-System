<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use App\Models\GraduationProject;
use App\Models\Post;
use App\Models\PostLabel;
use Illuminate\Support\Facades\Auth;

class SupervisorGraduationProjectController extends Controller
{
    private $project;
    private $students;



    public function index(){
        $gp_id = Supervisor::firstWhere('user_id', Auth::user()->id)->graduation_project_id;
        $project = GraduationProject::find($gp_id);

        return view('supervisor.Graduation-Project.teams', compact(['project']));
    }



    public function show(){
        
        $gp_id = Supervisor::firstWhere('user_id', Auth::user()->id)->graduation_project_id;
        $project = GraduationProject::find($gp_id);

        $labels = PostLabel::all();
        $posts = Post::where('graduation_project_id', $gp_id)->get()->sortDesc();

        return view('supervisor.Graduation-Project.team-details', compact(['project', 'labels', 'posts']));
    }




}
