<?php

namespace App\Http\Controllers\Timeline;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostLabel;
use App\Models\Student;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    public function index(){

        $student = Student::find(Auth::user()->id);
        if(!$student->graduation_project_id)
            return back();

        $labels = PostLabel::all();
        $posts = Post::where('graduation_project_id', $student->graduation_project_id)->get()->sortDesc();

        return view('student.Graduation-Project.Timeline.timeline', compact(['labels', 'posts']));
    }
}
