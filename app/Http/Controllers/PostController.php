<?php

namespace App\Http\Controllers;

use App\Enums\PostCategory;
use App\Enums\UserRole;
use App\Models\Post;
use App\Models\PostMeta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // =================================== Function ============================================
    protected function update_post_meta($post_id, $key, $value)
    {
        if (PostMeta::where('post_id', $post_id)->where('key', $key)->first()) {
            PostMeta::where('post_id', $post_id)->where('key', $key)->update(['value' => $value]);
            return 1;
        } else {
            PostMeta::insert([
                'post_id' => $post_id,
                'key' => $key,
                'value' => $value,
            ]);
            return 0;
        }
    }

    // =================================== Frontend Recuitment ============================================
    public function recruitment_post_details($id, Request $request)
    {
        $post = Post::find($id);

        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', ($request->ip())) . '-' . $post->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $post->id); //logged in user
        }

        $post->getInforRecruitment();
        $post->tags = $post->tags();


        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $post->increment('post_view'); //count the view
            return response()
                ->view('frontend.pages.recruitment-posts-details', [
                    'post' => $post
                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return view('frontend.pages.recruitment-posts-details', [
                'post' => $post
            ]); //this view is not counted
        }

    }

    // =================================== Recuitment ============================================
    public function recruitment_post_list()
    {
        if (Auth::user()->role == UserRole::Administrator) {
            $post_list = Post::where('post_type', PostCategory::Recruitment)->get();
        } else {
            $post_list = Post::where('post_type', PostCategory::Recruitment)->where('user_id', Auth::user()->id)->get();
        }

        foreach ($post_list as $v) {
            $v->user = User::find($v->user_id);
        }

        return view('admin.pages.recruitment-posts', compact('post_list'));
    }
    public function recruitment_post_create()
    {
        return view('admin.pages.recruitment-posts-create');
    }
    public function recruitment_post_store(Request $request)
    {
        $post_new = Post::create([
            'user_id' => Auth::user()->id,
            'post_title' => $request->title,
            'post_content' => $request->content,
            'post_status' => 'pendding',
            'post_type' => PostCategory::Recruitment,
        ]);

        if ($request->hasFile('avatar')) {
            $allowedfileExtension = ['jpg', 'png', 'gif', 'png', 'jpeg', 'svg', 'mp4'];
            $file = $request->file('avatar');
            // flag xem có thực hiện lưu DB không. Mặc định là có
            $exe_flg = true;
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);

            if (!$check) {
                // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                $exe_flg = false;
            }
            // nếu không có file nào vi phạm validate thì tiến hành lưu DB
            if ($exe_flg) {

                $extension = $file->getClientOriginalExtension();
                // $filename = $file->store('media');
                $file_name = Storage::put('/post', $file);
            }
        }

        PostMeta::insert([
            [
                'post_id' => $post_new->id,
                'key' => 'address',
                'value' => $request->address
            ],
            [
                'post_id' => $post_new->id,
                'key' => 'email',
                'value' => $request->email
            ],
            [
                'post_id' => $post_new->id,
                'key' => 'phone',
                'value' => $request->phone
            ],
            [
                'post_id' => $post_new->id,
                'key' => 'deadline',
                'value' => $request->deadline
            ],
            [
                'post_id' => $post_new->id,
                'key' => 'vacancy',
                'value' => $request->vacancy
            ],
            [
                'post_id' => $post_new->id,
                'key' => 'salary',
                'value' => $request->salary
            ],
            [
                'post_id' => $post_new->id,
                'key' => 'position',
                'value' => $request->position
            ],
            [
                'post_id' => $post_new->id,
                'key' => 'experience',
                'value' => $request->experience
            ],
            [
                'post_id' => $post_new->id,
                'key' => 'job-nature',
                'value' => $file_name
            ],
            [
                'post_id' => $post_new->id,
                'key' => 'image',
                'value' => $file_name
            ],
        ]);

        if ($request->submit == 'redirect') {
            return redirect()->route('admin.posts.recruitment.edit', $post_new->id)->with('success', 'Tạo thành công bài viết mới!');
        } else {
            return back()->with('success', 'Tạo thành công bài viết mới!');
        }
    }
    public function recruitment_post_edit($id)
    {
        if (!Post::whereId($id)->exists()) {
            return redirect('page-not-found');
        }
        $post = Post::find($id);
        $post->getInforRecruitment();
        return view('admin.pages.recruitment-posts-edit', compact('post'));
    }

    public function recruitment_post_update(Request $request, $id)
    {
        $post_status = 'pendding';
        if ($request->post_status)
            $post_status = $request->post_status;

        $post_update = Post::whereId($id)->update(
            [
                'post_title' => $request->title,
                'post_content' => $request->content,
                'post_status' => $post_status,
                'post_type' => PostCategory::Recruitment,
                'post_date_update' => Carbon::now()
            ]
        );

        if ($request->hasFile('avatar')) {
            $allowedfileExtension = ['jpg', 'png', 'gif', 'png', 'jpeg', 'svg', 'mp4'];
            $file = $request->file('avatar');
            // flag xem có thực hiện lưu DB không. Mặc định là có
            $exe_flg = true;
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);

            if (!$check) {
                // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                $exe_flg = false;
            }
            // nếu không có file nào vi phạm validate thì tiến hành lưu DB
            if ($exe_flg) {

                $file_old = PostMeta::where('post_id', $id)->where('key', 'image')->first() ? PostMeta::where('post_id', $id)->where('key', 'image')->first()->value : null;
                $del_file = !is_null($file_old) && Storage::delete($file_old);

                $extension = $file->getClientOriginalExtension();
                // $filename = $file->store('media');
                $file_name = Storage::put('/post', $file);
                $this->update_post_meta($id, 'image', $file_name);
            }
        }

        $this->update_post_meta($id, 'address', $request->address);
        $this->update_post_meta($id, 'email', $request->email);
        $this->update_post_meta($id, 'phone', $request->phone);
        $this->update_post_meta($id, 'deadline', $request->deadline);
        $this->update_post_meta($id, 'vacancy', $request->vacancy);
        $this->update_post_meta($id, 'salary', $request->salary);
        $this->update_post_meta($id, 'position', $request->position);
        $this->update_post_meta($id, 'experience', $request->experience);
        $this->update_post_meta($id, 'job-nature', $request->job_nature);

        return back()->with('success', 'cập nhật thành công!');
    }

    // =================================== News ============================================
    public function news_post_list()
    {
        $post_list = Post::where('post_type', PostCategory::News)->get();

        foreach ($post_list as $v) {
            $v->user = User::find($v->user_id);
        }

        return view('admin.pages.news-posts', compact('post_list'));
    }
    public function news_post_create()
    {
        return view('admin.pages.news-posts-create');
    }
    public function news_post_store(Request $request)
    {
        if (Auth::user()->role == UserRole::Administrator) {
            $post_status = 'publish';
        } else {
            $post_status = 'pendding';
        }

        $post_new = Post::create([
            'user_id' => Auth::user()->id,
            'post_title' => $request->title,
            'post_content' => $request->content,
            'post_status' => $post_status,
            'post_type' => PostCategory::News,
        ]);

        $file_name = '';

        if ($request->hasFile('avatar')) {
            $allowedfileExtension = ['jpg', 'png', 'gif', 'png', 'jpeg', 'svg', 'mp4'];
            $file = $request->file('avatar');
            // flag xem có thực hiện lưu DB không. Mặc định là có
            $exe_flg = true;
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);

            if (!$check) {
                // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                $exe_flg = false;
            }
            // nếu không có file nào vi phạm validate thì tiến hành lưu DB
            if ($exe_flg) {

                $extension = $file->getClientOriginalExtension();
                // $filename = $file->store('media');
                $file_name = Storage::put('/post', $file);
            }
        }

        PostMeta::insert([
            [
                'post_id' => $post_new->id,
                'key' => 'image',
                'value' => $file_name
            ],
        ]);

        if ($request->submit == 'redirect') {
            return redirect()->route('admin.posts.news.edit', $post_new->id)->with('success', 'Tạo thành công bài viết mới!');
        } else {
            return back()->with('success', 'Tạo thành công bài viết mới!');
        }
    }
    public function news_post_edit($id)
    {
        $post = Post::find($id);
        $post->news_image = PostMeta::where('post_id', $post->id)->where('key', 'image')->exists()
            ? PostMeta::where('post_id', $post->id)->where('key', 'image')->first()->value
            : '';
        return view('admin.pages.news-posts-edit', ['post' => $post]);
    }
    public function news_post_update(Request $request, $id)
    {
        if (isset($request->post_status) && (Auth::user()->role == UserRole::Administrator || $request->post_status != 'publish')) {

            $post_status = $request->post_status;

            $post_update = Post::whereId($id)->update(
                [
                    'post_title' => $request->title,
                    'post_content' => $request->content,
                    'post_date_update' => Carbon::now(),
                    'post_status' => $post_status,
                ]
            );
        } else {
            $post_update = Post::whereId($id)->update(
                [
                    'post_title' => $request->title,
                    'post_content' => $request->content,
                    'post_date_update' => Carbon::now()
                ]
            );
        }

        if ($request->hasFile('avatar')) {
            $allowedfileExtension = ['jpg', 'png', 'gif', 'png', 'jpeg', 'svg', 'mp4'];
            $file = $request->file('avatar');
            // flag xem có thực hiện lưu DB không. Mặc định là có
            $exe_flg = true;
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);

            if (!$check) {
                // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                $exe_flg = false;
            }
            // nếu không có file nào vi phạm validate thì tiến hành lưu DB
            if ($exe_flg) {

                $file_old = PostMeta::where('post_id', $id)->where('key', 'image')->first() ? PostMeta::where('post_id', $id)->where('key', 'image')->first()->value : null;
                $del_file = !is_null($file_old) && Storage::delete($file_old);

                $extension = $file->getClientOriginalExtension();
                // $filename = $file->store('media');
                $file_name = Storage::put('/post', $file);
                $this->update_post_meta($id, 'image', $file_name);
            }
        }

        return back()->with('success', 'cập nhật thành công!');
    }
}