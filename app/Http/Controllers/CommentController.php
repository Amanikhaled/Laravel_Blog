<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Comment;
use \App\Models\Post;
use \App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $post = Post::findOrFail($request->post_id);

        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        // Load the user relationship to access the user's name
        $comment->load('user');

        // Load the comments relationship on the post
        $post->load('comments');

        return view('posts.show', compact('post'))->with('comment', $comment);
    }


}
