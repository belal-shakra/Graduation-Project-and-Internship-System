<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPostRequest;
use App\Models\GraduationProject;
use App\Models\Post;
use App\Models\PostLabel;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class PostController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddPostRequest $request)
    {
        $post = $request->validated();

        $labels_count = PostLabel::all()->count();
        $pattern = '';
        $post['user_id'] = Auth::user()->id;

        for ($i=1; $i <= $labels_count; $i++) { 
            if(@$request[$i])
                $pattern.='1';
            else
                $pattern.='0';
        }
        $post['label_pattern'] = $pattern;
        



        try {
            $gp_id = Supervisor::firstWhere('user_id', Auth::user()->id)->graduation_project_id;
        } catch (\Throwable $th) {
            $gp_id = Student::firstWhere('user_id', Auth::user()->id)->graduation_project_id;
        }
        $post['graduation_project_id'] = $gp_id;



        Post::create($post);
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}
