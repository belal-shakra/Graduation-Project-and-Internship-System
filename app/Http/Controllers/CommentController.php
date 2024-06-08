<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use App\Models\Comment;
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
        return redirect('/graduation-project/timeline#'.$post->created_at->format('si'));
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
}
