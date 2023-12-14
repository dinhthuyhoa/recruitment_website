<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\EducationUser;
use App\Models\VolunteerActivity;
use App\Models\WorkExperience;
use App\Models\Skill;
use App\Models\Hobby;
use App\Models\Apply;
use App\Models\PostMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address,
            'birthday' => $request->birthday,
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
                $file_old = $user->avatar;
                $del_file = !is_null($user->avatar) && Storage::delete($file_old);

                $extension = $file->getClientOriginalExtension();
                // $filename = $file->store('media');
                $file_name = Storage::put('/avatar', $file);

                $user->avatar = $file_name;
            } else {
                return back()->with('error', 'Lỗi định dạng file tải lên không đúng!');
            }
        }

        if ($user->save()) {
            return back()->with('success', 'Cập nhật thành công');
        } else {
            return back()->with('error', 'Cập nhật thất bại');
        }
    }

    public function profile ($id, Request $request)
    {

        $user = User::find($id);

        $posts = Post::all();

        $posts = $posts->filter(function ($post) use ($user) {

            if ($user->is_post_favorite($post->id)) {
                return true;
            }

            return false;
        });
        
        $successMessageEdu = 'Cập nhật thành công thông tin trình độ học vấn!';
        session()->put('successMessageEdu', $successMessageEdu);
        dd($successMessageEdu);
        return view('frontend.pages.profile-user', [
            'user' => $user,
            'posts' => $posts,
            'successMessageEdu' => $successMessageEdu,
        ]);
    }

    public function saveEdu($id, Request $request)
    {
        $user = User::find($id);

        $request->validate([
            'schoolName' => 'required',
            'schoolAdd' => 'required',
            'startSchool' => 'required|date',
            'endSchool' => 'required|date|after:startSchool',
            'gpa' => 'numeric',
            'ttichEdu' => 'max:255',
        ]);
    
        $educationData = [
            'school_name' => $request->input('schoolName'),
            'school_location' => $request->input('schoolAdd'),
            'start_date' => $request->input('startSchool'),
            'end_date' => $request->input('endSchool'),
            'gpa' => $request->input('gpa'),
            'achievements' => $request->input('ttichEdu'),
            'user_id' => $user->id,
        ];
    
        $educationInfo = EducationUser::where('user_id', $user->id)->latest()->first();

        if ($educationInfo) {
            // dd('1');
            $educationInfo->update($educationData);
            $successMessageEdu = 'Cập nhật thành công thông tin trình độ học vấn!';
        } else {
            $educationInfo = EducationUser::create($educationData);
            $successMessageEdu = 'Tạo thành công thông tin trình độ học vấn mới!';
        }
        session()->put('successMessageEdu', $successMessageEdu);
        // dd(session('successMessageEdu'));

        return redirect()->route('profile.user', $id)->with('successMessageEdu', $successMessageEdu);


        // return redirect()->back()->with('success', 'Thông tin học vấn đã được cập nhật.');
    }



    public function saveWork($id, Request $request)
    {
        $user = User::find($id);

        $request->validate([
            'workPosition' => 'required',
            'company' => 'required',
            'workAdd' => 'required',
            'startWork' => 'required|date',
            'endWork' => 'required|date|after:startWork',
            'ttichWork' => 'max:255',
        ]);
        $workData = [
            'work_position' => $request->input('workPosition'),
            'company' => $request->input('company'),
            'work_address' => $request->input('workAdd'),
            'start_date' => $request->input('startWork'),
            'end_date' => $request->input('endWork'),
            'achievements' => $request->input('ttichWork'),
            'user_id' => $user->id,
        ];


        $workInfo = WorkExperience::where('user_id', $user->id)->latest()->first();
        // dd($workInfo);
        if ($workInfo) {
            $workInfo->update($workData);
            $successMessage = 'Cập nhật thành công thông tin kinh nghiệm làm việc!';
        } else {
            WorkExperience::create($workData);
            $successMessage = 'Tạo thành công thông tin kinh nghiệm làm việc mới!';
        }

        return redirect()->route('profile.user', $id);
    }

    public function saveVolun($id, Request $request)
    {
        $user = User::find($id);

        $request->validate([
            'volunPosition' => 'required',
            'volunEvent' => 'required',
            'volunAdd' => 'required',
            'startVolun' => 'required|date',
            'endVolun' => 'required|date|after:startVolun',
            'ttichVolun' => 'max:255',
        ]);

        $volunData = [
            'position' => $request->input('volunPosition'),
            'organization_name' => $request->input('volunEvent'),
            'location' => $request->input('volunAdd'),
            'start_date' => $request->input('startVolun'),
            'end_date' => $request->input('endVolun'),
            'achievements' => $request->input('ttichVolun'),
            'user_id' => $user->id,
        ];

        $volunInfo = VolunteerActivity::where('user_id', $user->id)->latest()->first();

        if ($volunInfo) {
            $volunInfo->update($volunData);
            $successMessage = 'Cập nhật thành công thông tin hoạt động tình nguyện!';
        } else {
            VolunteerActivity::create($volunData);
            $successMessage = 'Tạo thành công thông tin hoạt động tình nguyện mới!';
        }

        return redirect()->route('profile.user', $id)->with('successMessageVolun', $successMessage);
    }

    public function saveSkill($id, Request $request)
    {
        $user = User::find($id);
    
        $request->validate([
            'skillName' => 'required',
            'levelSkill' => 'required|in:Average,Good,Excellent,Masterful',
        ]);
    
        $skillData = [
            'name' => $request->input('skillName'),
            'description' => $request->input('levelSkill'),
            'user_id' => $user->id,
        ];
    
        $skillInfo = Skill::where('user_id', $user->id)->first();
    
        if ($skillInfo) {
            $skillInfo->update($skillData);
            $successMessage = 'Cập nhật thành công thông tin kỹ năng!';
        } else {
            Skill::create($skillData);
            $successMessage = 'Tạo thành công thông tin kỹ năng mới!';
        }
    
        return redirect()->route('profile.user', $id)->with('successMessageSkill', $successMessage);
    }

    public function saveHobby($id, Request $request)
    {
        $user = User::find($id);

        $request->validate([
            'hobbyName' => 'required|max:255',
        ]);

        $hobbyData = [
            'name' => $request->input('hobbyName'),
            'user_id' => $user->id,
        ];

        $hobbyInfo = Hobby::where('user_id', $user->id)->first();

        if ($hobbyInfo) {
            $hobbyInfo->update($hobbyData);
            $successMessage = 'Cập nhật thành công thông tin sở thích!';
        } else {
            Hobby::create($hobbyData);
            $successMessage = 'Tạo thành công thông tin sở thích mới!';
        }

        return redirect()->route('profile.user', $id);
    }
    public function showEducationInfo($id)
    {
        $user = User::find($id);
        // dd($user);
        $posts = Post::all();
        $applies = Apply::where('user_id', $user->id)->get();
        $appliedPosts = [];

        // Lặp qua danh sách các đơn apply để lấy thông tin của bài post
        foreach ($applies as $apply) {
            $postId = $apply->post_id;
            $appliedPosts[] = Post::find($postId);
        }
        $postMetas = [];
        $posts = $posts->filter(function ($post) use ($user, &$postMetas) {
        
            if ($user->is_post_favorite($post->id)) {
                $postMeta = $post->getInforRecruitment();
                $postMetas[] = [
                    'post' => $post,
                    'meta' => [
                        'recruitment_address' => $post->recruitment_address,
                        'recruitment_job_nature' => $post->recruitment_job_nature,
                        'recruitment_vacancy' => $post->recruitment_vacancy,
                        'recruitment_salary' => $post->recruitment_salary,
                        'recruitment_email' => $post->recruitment_email,
                        'recruitment_phone' => $post->recruitment_phone,
                        'recruitment_position' => $post->recruitment_position,
                        'recruitment_experience' => $post->recruitment_experience,
                        'recruitment_deadline' => $post->recruitment_deadline,
                        'post_date' => $post->post_date,
                        'post_date_update' => $post->post_date_update,
                    ],
                ];
                return true;
            }
        
            return false;
        });



        $educationInfo = $user ? EducationUser::where('user_id', $user->id)->first() : null;
        // dd($educationInfo);
        $workInfo = $user ? WorkExperience::where('user_id', $user->id)->first() : null;
        $volunInfo = $user ? VolunteerActivity::where('user_id', $user->id)->first() : null;
        $skillInfo = $user ? Skill::where('user_id', $user->id)->first() : null;
        $hobbyInfo = $user ? Hobby::where('user_id', $user->id)->first() : null;
        return view('frontend.pages.profile-user', [
            'appliedPosts' => $appliedPosts,
            'user' => $user,
            'posts' => $posts,
            'postMetas' => $postMetas,
            'educationInfo' => $educationInfo, 
            'workInfo' => $workInfo,
            'volunInfo' => $volunInfo,
            'skillInfo' => $skillInfo,
            'hobbyInfo' => $hobbyInfo,
        ]);
    }

    // Trong Model Post
public function meta()
{
    return $this->hasOne(PostMeta::class, 'post_id');
}

}
