<?php

namespace App\Http\Controllers;

use App\Models\PostFavorite;
use Illuminate\Http\Request;

class PostFavoriteController extends Controller
{

    public function change_post_favorite(Request $request)
    {
        if (PostFavorite::where('post_id', $request->post_id)->where('user_id', $request->user_id)->exists()) {
            $status = PostFavorite::where('post_id', $request->post_id)->where('user_id', $request->user_id)->first()->status;

            if ($status == 1) {
                PostFavorite::where('post_id', $request->post_id)->where('user_id', $request->user_id)->update([
                    'status' => 0,
                ]);
                return response()->json([
                    'title' => 'Success',
                    'text' => 'Post removed from favorites.',
                    'status' => 'remove'
                ]);
            } else {
                PostFavorite::where('post_id', $request->post_id)->where('user_id', $request->user_id)->update([
                    'status' => 1,
                ]);
                return response()->json([
                    'title' => 'Success',
                    'text' => 'Post added to favorites.',
                    'status' => 'add'
                ]);
            }
        } else {
            PostFavorite::create([
                'post_id' => $request->post_id,
                'user_id' => $request->user_id,
                'status' => 1,
            ]);
            return response()->json([
                'title' => 'Success',
                'text' => 'Post added to favorites.',
                'status' => 'add'
            ]);

        }
    }
}