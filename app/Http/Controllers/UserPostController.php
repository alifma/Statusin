<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user) {
        $post = $user->posts()->with(['user', 'likes'])->paginate(20);
        return view('users.posts.index', [
            'users' => $user,
            'posts' => $post
        ]);
    }
}
