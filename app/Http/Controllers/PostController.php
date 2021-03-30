<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index() {
        $post = Post::get();
        return view('posts.index', [
            'posts' => $post
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required'
        ]);

        auth()->user()->posts()->create($request->only('body'));

        return back();
    }
}
