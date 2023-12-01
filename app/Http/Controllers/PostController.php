<?php

namespace App\Http\Controllers;

use App\Enums\PostCategory;
use App\Enums\UserRole;
use App\Models\Post;
use App\Models\PostMeta;
use App\Models\Tag;
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

    protected function filter($list, $filters = [])
    {
        return $list->filter(function ($post, $key) use ($filters) {
            $check_temp = false;

            foreach ($filters as $k => $v) {
                if ($post->$k == $v) {
                    $check_temp = true;
                } else {
                    return false;
                }
            }

            return $check_temp;
        });
    }

    protected function stripVN($text)
    {
        $text = html_entity_decode($text);
        $text = preg_replace("/(ä|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
        $text = str_replace("ç", "c", $text);
        $text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);
        $text = preg_replace("/(ì|í|î|ị|ỉ|ĩ)/", 'i', $text);
        $text = preg_replace("/(ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);
        $text = preg_replace("/(ü|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);
        $text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
        $text = preg_replace("/(đ)/", 'd', $text);
        $text = preg_replace("/(Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $text);
        $text = str_replace("Ç", "a", $text);
        $text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $text);
        $text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $text);
        $text = preg_replace("/(Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $text);
        $text = preg_replace("/(Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $text);
        $text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $text);
        $text = preg_replace("/(Đ)/", 'd', $text);
        $text = str_replace(" / ", "-", $text);
        $text = str_replace("/", "-", $text);
        $text = str_replace(" - ", "-", $text);
        $text = str_replace("_", "-", $text);
        $text = str_replace(" ", "-", $text);
        $text = str_replace("ß", "ss", $text);
        $text = str_replace("&", "", $text);
        $text = str_replace("%", "", $text);
        $text = preg_replace("[^A-Za-z0-9-]", "", $text);
        $text = str_replace("----", "-", $text);
        $text = str_replace("---", "-", $text);
        $text = str_replace("--", "-", $text);
        $text = preg_replace("/( |!||#|$|%|')/", '', $text);
        $text = preg_replace("/(̀|́|̉|$|>)/", '', $text);
        $text = preg_replace("'<[\/\!]*?[^<>]*?>'si", "", $text);
        
        $text = strtolower($text);
        return $text;
    }

    // ====================================== Frontend News ===============================================
    public function news_post_list(Request $request)
    {
        $all_posts = Post::where([
            ['post_type', PostCategory::News],
            ['post_status', 'publish']
        ])->get();

        $count_post = count($all_posts);

        $tags = Tag::where('tag_category', 'post-news')->orderBy('tag_name')->get();

        foreach ($all_posts as $post) {
            $post->getInforRecruitment();
            $post->tags;
            $post->author = User::find($post->user_id)->name;
        }

        if ($request->has('keyword') && $request->get('keyword') != null) {
            $query = $this->stripVN(strtolower($request->get('keyword')));
            $all_posts = $all_posts->filter(function ($post) use ($query) {
                if (Str::contains($this->stripVN(strtolower($post->post_title)), $query)) {
                    return true;
                }

                if (Str::contains($this->stripVN(strtolower($post->author)), $query)) {
                    return true;
                }

                return false;
            });

        }

        if ($request->has('tag') && $request->get('tag') != null) {
            $tag = $request->get('tag');
            $all_posts = $all_posts->filter(function ($post) use ($tag) {
                return $post->tags->contains('tag_key', $tag);
            });
        }


        return view('frontend.pages.news-list', [
            'posts' => $all_posts,
            'tags' => $tags,
            'count_post' => $count_post
        ]);
    }

    public function news_post_details($id, Request $request)
    {
        $post = Post::find($id);

        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', ($request->ip())) . '-' . $post->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $post->id); //logged in user
            cookie($cookie_name, '1', 60);
        }

        $post->tags;
        $post->author = User::find($post->user_id)->name;
        $post->user = User::find($post->user_id);

        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $post->increment('post_view'); //count the view
            return response()
                ->view('frontend.pages.news-details', [
                    'post' => $post
                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return view('frontend.pages.news-details', [
                'post' => $post
            ]); //this view is not counted
        }
    }


    // =================================== Frontend Recuitment ============================================
    public function recruitment_post_list(Request $request)
    {
        $all_posts = Post::where([
            ['post_type', PostCategory::Recruitment],
            ['post_status', 'publish']
        ])->get();

        // dd($all_posts);
        $count_post = count($all_posts);

        $tags = Tag::where('tag_category', 'post-recruiment')->orderBy('tag_name')->get();

        foreach ($all_posts as $post) {
            $post->getInforRecruitment();
            $post->tags;
            $post->author = User::find($post->user_id)->name;
        }

        if ($request->has('keyword') && $request->get('keyword') != null) {
            $query = $this->stripVN(strtolower($request->get('keyword')));
            $all_posts = $all_posts->filter(function ($post) use ($query) {
                if (Str::contains($this->stripVN(strtolower($post->post_title)), $query)) {
                    return true;
                }

                if (Str::contains($this->stripVN(strtolower($post->author)), $query)) {
                    return true;
                }

                if (Str::contains($this->stripVN(strtolower($post->recruitment_address)), $query)) {
                    return true;
                }

                return false;
            });

        }

        if ($request->has('filter_address') && $request->get('filter_address') != null) {
            $query = $this->stripVN(strtolower($request->get('filter_address')));

            $all_posts = $all_posts->filter(function ($post) use ($query) {
                if (Str::contains($this->stripVN(strtolower($post->recruitment_address)), $query)) {
                    return true;
                }

                if ($query == $this->stripVN(strtolower('HCM'))) {
                    if (Str::contains($this->stripVN(strtolower($post->recruitment_address)), $this->stripVN(strtolower('Ho Chi Minh')))) {

                        return true;
                    }

                    if (Str::contains($this->stripVN(strtolower($post->recruitment_address)), $this->stripVN(strtolower('HoChiMinh')))) {

                        return true;
                    }

                    if (Str::contains($this->stripVN(strtolower($post->recruitment_address)), $this->stripVN(strtolower('TP.HCM')))) {

                        return true;
                    }

                    if (Str::contains($this->stripVN(strtolower($post->recruitment_address)), $this->stripVN(strtolower('Sai Gon')))) {
                        return true;
                    }
                }

                if ($query == $this->stripVN(strtolower('Can Tho'))) {

                    if (Str::contains($this->stripVN(strtolower($post->recruitment_address)), $this->stripVN(strtolower('CanTho')))) {

                        return true;
                    }

                    if (Str::contains($this->stripVN(strtolower($post->recruitment_address)), $this->stripVN(strtolower('TPCT')))) {

                        return true;
                    }
                }

                return false;
            });

        }
        if ($request->has('filter_job_nature') && $request->get('filter_job_nature') != null) {
            $query = $this->stripVN(strtolower($request->get('filter_job_nature')));
            $all_posts = $all_posts->filter(function ($post) use ($query) {
                
                if (Str::contains($this->stripVN(strtolower($post->recruitment_job_nature)), $query)) {
                    return true;
                }
                return false;
            });

        }

        if ($request->has('filter_position') && $request->get('filter_position') != null) {
            $query = $this->stripVN(strtolower($request->get('filter_position')));
            // dd($query);
        
            $all_posts = $all_posts->filter(function ($post) use ($query) {
                if (stripos($post->recruitment_position, $query) !== false) {
                    return true;
                }
                return false;
            });

        }
        
        
        if ($request->has('filter_salary') && $request->get('filter_salary') != null) {
            $query = $this->stripVN(strtolower($request->get('filter_salary')));
            $all_posts = $all_posts->filter(function ($post) use ($query) {
                if (stripos($post->recruitment_salary, $query) !== false) {
                    return true;
                }
                return false;
                
            });
        }
        

        if ($request->has('tag') && $request->get('tag') != null) {
            $tag = $request->get('tag');
            $all_posts = $all_posts->filter(function ($post) use ($tag) {
                return $post->tags->contains('tag_key', $tag);
            });
        }


        return view('frontend.pages.all-jobs', [
            'posts' => $all_posts,
            'tags' => $tags,
            'count_post' => $count_post
        ]);
    }

private function formatSalary($salary)
{
    $formattedSalary = str_replace('negotiable', '0', $salary);
    $formattedSalary = str_replace('-', ' - ', $formattedSalary);
    $formattedSalaryParts = explode(' - ', $formattedSalary);
    $formattedSalaryParts = array_map(
        fn ($part) => $part == '0' ? 'Thỏa thuận' : ($part === '10000000' ? trans('all-jobs.over') . ' 10,000,000' : number_format((float) $part, 0, ',', '.')),
        $formattedSalaryParts
    );
    $formattedSalary = implode(' - ', $formattedSalaryParts);
    return $formattedSalary;
}

    public function recruitment_post_details($id, Request $request)
    {
        $post = Post::find($id);

        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', ($request->ip())) . '-' . $post->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $post->id); //logged in user
            cookie($cookie_name, '1', 60);
        }

        $post->getInforRecruitment();
        $post->tags = $post->tags;
        $post->author = User::find($post->user_id)->name;

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
    public function admin_recruitment_post_list()
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
    public function admin_recruitment_post_create()
    {
        return view('admin.pages.recruitment-posts-create');
    }
    public function admin_recruitment_post_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'deadline' => 'required|date',
            'vacancy' => 'required|numeric',
            'salary' => 'required',
            'position' => 'required',
            'experience' => 'required',
            'job_nature' => 'required',
            // 'avatar' => 'nullable|image|mimes:jpg,png,gif,jpeg,svg,mp4|max:2048',
        ]);
    
        $file_name = null;
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
        else {
            $message_image = "Chưa tải ảnh lên";
            return view('admin.pages.recruitment-posts-create', compact($message_image));
        }

        $post_new = Post::create([
            'user_id' => Auth::user()->id,
            'post_title' => $request->title,
            'post_content' => $request->content,
            'post_status' => 'pendding',
            'post_type' => PostCategory::Recruitment,
            'post_image' => $file_name
        ]);

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
                'value' => $request->job_nature
            ],
        ]);

        if ($request->submit == 'redirect') {
            session()->put('successMessage', 'Tạo thành công bài viết mới!');

            if (session()->has('successMessage')) {
                $successMessage = session('successMessage');

                $post = Post::find($post_new->id);
                $post->getInforRecruitment();
                return view('admin.pages.recruitment-posts-edit', compact('post', 'successMessage'));
            }

        } else {
            return back()->with('successMessage', 'Tạo thành công bài viết mới!');
        }
    }
    public function admin_recruitment_post_edit($id)
    {
        if (!Post::whereId($id)->exists()) {
            return redirect('page-not-found');
        }
        $post = Post::find($id);
        $post->getInforRecruitment();
        
        return view('admin.pages.recruitment-posts-edit', compact('post'));
    }

    public function admin_recruitment_post_update(Request $request, $id)
    {

        $post_status = 'pendding';
        if ($request->post_status)
            $post_status = $request->post_status;

        $post_update = Post::whereId($id);

        $post_update_result = $post_update->update(
            [
                'post_title' => $request->title,
                'post_content' => $request->content,
                'post_status' => $post_status,
                'post_type' => PostCategory::Recruitment,
                'post_date_update' => Carbon::now()
            ]
        );

        if ($post_update_result) {
            if (session()->has('successMessage')) {
                // session()->forget('successMessage');
                dd('1');
            }

            session()->put('successMessageUpdate', 'Cập nhật thành công bài viết mới!');
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

                $file_old = Post::find($id)? Post::find($id)->post_image : null;
                $del_file = !is_null($file_old) && Storage::delete($file_old);

                $extension = $file->getClientOriginalExtension();
                // $filename = $file->store('media');
                $file_name = Storage::put('/post', $file);

                $post_update->update([
                    'post_image' => $file_name
                ]);
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

        return redirect()->route('admin.posts.recruitment.edit', $id);
    }

    public function admin_recruitment_post_delete($id){
        Post::whereId($id)->delete();
        return redirect()
            ->route('admin.posts.recruitment.list')
            ->with('success', 'Đã xóa bài viết thành công');
    }
    // =================================== News ============================================
    public function admin_news_post_list()
    {
        $post_list = Post::where('post_type', PostCategory::News)->get();

        foreach ($post_list as $v) {
            $v->user = User::find($v->user_id);
        }

        return view('admin.pages.news-posts', compact('post_list'));
    }
    public function admin_news_post_create()
    {
        return view('admin.pages.news-posts-create');
    }
    public function admin_news_post_store(Request $request)
    {
        // dd($request->description);
        if (Auth::user()->role == UserRole::Administrator) {
            $post_status = 'publish';
        } else {
            $post_status = 'pendding';
        }

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

        $post_new = Post::create([
            'user_id' => Auth::user()->id,
            'post_title' => $request->title,
            'post_description' => $request->description,
            'post_content' => $request->content,
            'post_status' => $post_status,
            'post_type' => PostCategory::News,
            'post_image' => $file_name
        ]);

        if ($request->submit == 'redirect') {
            session()->put('successMessage', 'Tạo thành công bài viết mới!');

            if (session()->has('successMessage')) {
                $successMessage = session('successMessage');

                $post = Post::find($post_new->id);
                $post->getInforRecruitment();

                return view('admin.pages.news-posts-edit', compact('post', 'successMessage'));
            }

            // return redirect()->route('admin.posts.news.edit', $post_new->id)->with('success', 'Tạo thành công bài viết mới!');
        } else {
            return back()->with('success', 'Tạo thành công bài viết mới!');
        }
    }
    public function admin_news_post_edit($id)
    {
        $post = Post::find($id);
        $post->news_image = $post->post_image;

        return view('admin.pages.news-posts-edit', ['post' => $post]);
    }

    public function admin_news_post_update(Request $request, $id)
    {
        $post_update = Post::whereId($id);
        if (isset($request->post_status) && (Auth::user()->role == UserRole::Administrator || $request->post_status != 'publish')) {

            $post_status = $request->post_status;
            $post_update_result = $post_update->update(
                [
                    'post_title' => $request->title,
                    'post_description' => $request->description,
                    'post_content' => $request->content,
                    'post_date_update' => Carbon::now(),
                    'post_status' => $post_status,
                ]
            );
            if ($post_update_result) {
                if (session()->has('successMessage')) {
                    // session()->forget('successMessage');
                    dd('1');
                }
    
                session()->put('successMessageUpdate', 'Cập nhật thành công bài viết mới!');
            }
        } else {
            
            $post_update_result = $post_update->update(
                [
                    'post_title' => $request->title,
                    'post_description' => $request->description,
                    'post_content' => $request->content,
                    'post_status' => $request->post_status,
                    'post_date_update' => Carbon::now()
                ]
            );
            if ($post_update_result) {
                if (session()->has('successMessage')) {
                    // session()->forget('successMessage');
                    dd('1');
                }
    
                session()->put('successMessageUpdate', 'Cập nhật thành công bài viết mới!');
            }
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

                $post_update->update(
                    [
                        'post_image' => $file_name,
                    ]
                );
            }
        }
        return redirect()->route('admin.posts.news.edit', $id);
        // return view('admin.pages.news-posts-edit', $id);
    }

    public function admin_news_post_delete($id){
        Post::whereId($id)->delete();
        return redirect()
            ->route('admin.posts.news.list')
            ->with('success', 'Đã xóa bài viết thành công');
    }
}
