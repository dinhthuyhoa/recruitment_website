<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Post;
use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplyController extends Controller
{
    public function list()
    {

        $apply_list = Apply::all();
        foreach ($apply_list as $v) {
            $v->post_title = Post::find($v->post_id)->post_title;
            $v->user = User::find($v->user_id);
            $v->recruiter = Recruiter::where('user_id', Post::find($v->post_id)->user_id)->first();
        }
        
        return view('admin.pages.job-apply-list', ['apply_list' => $apply_list]);
    }

    public function candidate_apply(Request $request)
    {


        if ($request->hasFile('attachment')) {
            $allowedfileExtension = ['jpg', 'png', 'pdf', 'png', 'jpeg', 'jpd', 'doc', 'docx'];
            $file = $request->file('attachment');
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
                $file_name = Storage::put('/apply_attachment', $file);

                $new_apply = Apply::insert([
                    'fullname' => $request->fullname,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'birthday' => $request->birthday,
                    'address' => $request->address,
                    'gender' => $request->gender,
                    'status' => 'pendding',
                    'attachment' => $file_name,
                    'post_id' => $request->post_id,
                    'user_id' => Auth::user()->id,
                ]);
                return back()->with('success', 'Đã nộp yêu cầu');
            } else {
                return back()->with('error', 'File không hợp lệ');
            }
        } else {
            $new_apply = Apply::insert([
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'gender' => $request->gender,
                'status' => 'pendding',
                'post_id' => $request->post_id,
                'user_id' => Auth::user()->id,
            ]);
            return back()->with('success', 'Đã nộp yêu cầu không kèm CV');

        }

    }
}