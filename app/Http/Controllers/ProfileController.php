<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
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
}
