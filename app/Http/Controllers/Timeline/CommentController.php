<?php


namespace App\Http\Controllers\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCommentRequest;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Post $post, AddCommentRequest $request)
    {
        $comment = $request->validated();
        $comment['user_id'] = Auth::user()->id;
        $comment['post_id'] = $post->id;

        Comment::create($comment);

        $this->notify_students($post, '#'.$post->created_at->format('si'));
        return redirect(url()->previous().'#'.$post->created_at->format('si'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if(Auth::user()->id == $comment->user_id)
            $comment->delete();
        return back();
    }


    public function notify_students(Post $post, string $id){

        Notification::create([
            'title'   => 'Graduation Project | Timeline',
            'message' => 'Someone comment on your post.',
            'type' => 'student',
            'is_read' => false,
            'route' => route('student.timeline').$id,
            'user_id' => $post->user_id,
        ]);
    }
}
