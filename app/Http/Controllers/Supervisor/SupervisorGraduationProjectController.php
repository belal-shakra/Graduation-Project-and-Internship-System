<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
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
        
        $projects = Auth::user()->supervisor->graduation_projects;
        return view('supervisor.Graduation-Project.teams', compact(['projects']));
    }



    public function show(GraduationProject $graduation_project){
        
        if(!($graduation_project->supervisors->contains(Auth::user()->supervisor)))
            return to_route('supervisor.teams');


        $project = $graduation_project;
        $labels = PostLabel::all();
        $posts = Post::where('graduation_project_id', $graduation_project->id)->get()->sortDesc();


        return view('supervisor.Graduation-Project.team-details', compact(['project', 'labels', 'posts']));
    }




}
