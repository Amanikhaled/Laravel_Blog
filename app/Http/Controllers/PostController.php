<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
class PostController extends Controller
{


    public function index()
    {
        // $posts = Auth::user()->posts;
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Create a new post for the authenticated user
        Auth::user()->posts()->create($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($postId)
    {
        $post = Post::with('comments.user')->findOrFail($postId);
        return view('posts.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $post=Post::findOrFail($id);
            if ($post->user_id !==auth()->id()){
                return redirect()->route('posts.index')->with('error', 'you are not the owner of the post ');
            }

            return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post =Post::findorFail($id);
        if($post->user_id !==auth()->id()){
            return redirect()->route('posts.index')->with('error', 'you are not the owner of the post');
        }
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post->update($validatedData);
        return redirect()->route('posts.index')->with('success','post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        if($post->user_id !==auth()->id()){

            return redirect()->route('posts.index')->with('error', 'you are not the owner of the post');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
