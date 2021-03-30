<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $post = Post::latest()->with(['user', 'likes'])->paginate(10);
        return view('posts.index', [
            'posts' => $post
        ]);
    }

    public function show(Post $post) {
        return view('posts.show', [
            'post' => $post
        ]);
    }
    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required'
        ]);

        auth()->user()->posts()->create($request->only('body'));

        return back();
    }


    public function destroy(Post $post) {

        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}
