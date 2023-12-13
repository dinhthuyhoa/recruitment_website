<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\FailedApplication;
use App\Mail\PendingApplication;
use App\Models\Apply;
use App\Models\Post;
use App\Models\PostMeta;

use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplyController extends Controller
{
    public function __construct()
    {
        // function sendMail($to = null, $subject, $title, $body, $view)
        // {
        //     $mailData = [
        //         'view' => $view,
        //         'subject' => $subject ? $subject : env('APP_NAME'),
        //         'title' => $title,
        //         'body' => $body,
        //     ];

        //     if ($to != null) {
        //         $to .= ',' . env('MAIL_LIST_CONFIRM');
        //     } else {
        //         $to = env('MAIL_LIST_CONFIRM');
        //     }

        //     $list_send_mail = explode(',', $to);

        //     foreach ($list_send_mail as $email) {
        //         Mail::to($email)->send(new SendMail($mailData));
        //     }
        // }
    }

    public function list()
    {

        $apply_list = Apply::all();
        foreach ($apply_list as $v) {
            $v->post = Post::find($v->post_id);
            $v->user = User::find($v->user_id);
        }

        $apply_list = $apply_list->filter(function ($apply) {

            if ($apply->post->user->id == Auth::user()->id) {
                return true;
            }

            return false;
        });


        return view('admin.pages.job-apply-list', ['apply_list' => $apply_list]);
    }

    public function candidate_apply(Request $request)
    {
        $user = Auth::check() ? Auth::user()->id : null;

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
                    'status' => 'pending',
                    'attachment' => $file_name,
                    'post_id' => $request->post_id,
                    'user_id' => $user,
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
                'status' => 'pending',
                'post_id' => $request->post_id,
                'user_id' => $user,
            ]);
            return back()->with('success', 'Đã nộp yêu cầu không kèm CV');
        }
    }

    public function edit($id)
    {
        $apply = Apply::find($id);
        $apply->post = Post::find($apply->post_id);
        $apply->post->getInforRecruitment();
        $apply->user = User::find($apply->user_id);
        return view('admin.pages.job-apply-edit', ['apply' => $apply]);
    }

    public function update_status($id, Request $request)
    {
        $apply = Apply::find($id);
        // $apply_status_old = $apply->status;

        $post = Post::find($apply->post_id);
        $post_meta = PostMeta::where('post_id', $post->id)->get();

        $recruiter = User::find($post->user_id);
        $apply->update([
            'status' => $request->apply_status
        ]);

        // if ($apply_status_old != $request->apply_status) {
            $body = [
                'status' => $request->apply_status,
                'candidate_name' => $apply->fullname,
                'post' => $post,
                'recruiter' => $recruiter,
                'message' => $request->message,
            ];
            $to = $apply->email;

            switch ($request->apply_status) {
                case 'approved':
                    $body['result'] = 'Đậu ứng tuyển';
                    Mail::to($to)->send(new SendMail($body));
                    return back()->with('success', 'Đã gửi mail đến ứng viên và admin');
                    break;
            
                case 'failed':
                    $body['result'] = 'Trượt ứng tuyển';
                    Mail::to($to)->send(new FailedApplication($body));
                    return back()->with('success', 'Đã gửi mail đến ứng viên và admin');
                    break;
            
                case 'pending':
                    $body['result'] = 'Chờ duyệt ứng tuyển';
                    Mail::to($to)->send(new PendingApplication($body));
                    return back()->with('success', 'Đã gửi mail chờ duyệt đến ứng viên');
                    break;
            
                // Thêm các trạng thái khác nếu cần
            
                default:
                    return back()->with('success', 'Cập nhật trạng thái thành công');
                    break;
            }
        // }
    
        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
    

}
