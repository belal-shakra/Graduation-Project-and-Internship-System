<?php

namespace App\Http\Controllers\Timeline;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostLabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    public function index(){

        if(!Auth::user()->student->graduation_project_id)
            return back();

        $labels = PostLabel::all();
        $posts = Post::where('graduation_project_id', Auth::user()->student->graduation_project_id)->get()->sortDesc();

        return view('student.Graduation-Project.Timeline.timeline', compact(['labels', 'posts']));
    }
}
