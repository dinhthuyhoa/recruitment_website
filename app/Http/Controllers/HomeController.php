<?php

namespace App\Http\Controllers;

use App\Enums\PostCategory;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recruitment_post_list = Post::where('post_type', PostCategory::Recruitment)->where('post_status', 'publish')->limit(5)->get();
        foreach ($recruitment_post_list as $post) {
            $post->getInforRecruitment();
            $post->tags();
            $post->author = User::find($post->user_id)->name;

        }
        $tags = Tag::where('tag_category', 'post-recruiment')->orderBy('tag_name')->get();
        return view('frontend.pages.home', [
            'recruitment_post_list' => $recruitment_post_list,
            'tags' => $tags
        ]);
    }

    public function storeImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('storage/ckeditor-media'), $fileName);

            $url = asset('storage/ckeditor-media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function terms_of_servive(){
        return view('frontend.pages.terms_of_servive');
    }
}
