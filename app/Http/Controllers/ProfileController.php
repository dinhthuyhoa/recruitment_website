<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id, Request $request)
    {

        $user = User::find($id);

        $posts = Post::all();

        $posts = $posts->filter(function ($post) use ($user) {

            if ($user->is_post_favorite($post->id)) {
                return true;
            }

            return false;
        });

        return view('frontend.pages.profile', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
