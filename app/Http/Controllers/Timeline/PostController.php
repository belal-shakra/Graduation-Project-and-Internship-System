<?php


namespace App\Http\Controllers\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPostRequest;
use App\Models\Comment;
use App\Models\File;
use App\Models\GraduationProject;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostLabel;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddPostRequest $request)
    {
        // request validation.
        $post = $request->validated();

        // Post's label handling.
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




        // get the graduation project id.
        try {
            $gp_id = Supervisor::firstWhere('user_id', Auth::user()->id)->graduation_project_id;
        } catch (\Throwable $th) {
            $gp_id = Student::firstWhere('user_id', Auth::user()->id)->graduation_project_id;
        }
        $post['graduation_project_id'] = $gp_id;



        // create a post record
        $post_rec = Post::create($post);


        // create a file record/s
        if($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $this->file_proccessing($file, $post_rec->id);

                File::create([
                    'post_id' => $post_rec->id,
                    'file' => substr($path, strrpos($path, "/")+1),
                    'extension' => explode("/", $file->getMimeType())[1],
                    'path' => substr($path, 0,strrpos($path, "/")),
                ]);
            }
        }





        $this->notify_students(Auth::user()->student->graduation_project);
        $this->notify_supervisors(Auth::user()->student->graduation_project);

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
        foreach(File::where('post_id', $post->id)->get() as $file){
            $file->delete();
        }

        foreach(Comment::where('post_id', $post->id)->get() as $comment){
        $comment->delete();
        }

        $post->delete();
        return back();
    }


    public function file_proccessing($file, $post_id)
    {
        $new_name =  time().'-'.$file->getClientOriginalName();
        $file_path = $file->storeAs('files/Graduation-Project/'. $post_id, $new_name, 'public');

        return $file_path;
    }




    public function notify_students(GraduationProject $graduation_project){

        foreach($graduation_project->students as $student){

            if($student->id == Auth::user()->student->id)
                continue;


            Notification::create([
                'title'   => 'Graduation Project | Timeline',
                'message' => 'Someone add new post to project timeline.',
                'type' => 'student',
                'is_read' => false,
                'route' => route('student.timeline'),
                'user_id' => $student->user->id,
            ]);
        }
    }



    public function notify_supervisors(GraduationProject $graduation_project){

        foreach($graduation_project->supervisors as $supervisor){
            Notification::create([
                'title'   => 'Graduation Project | Timeline',
                'message' => 'Someone add new post to project timeline.',
                'type' => 'supervisor',
                'is_read' => false,
                'route' => route('supervisor.show', $graduation_project),
                'user_id' => $supervisor->user->id,
            ]);
        }
    }
}
