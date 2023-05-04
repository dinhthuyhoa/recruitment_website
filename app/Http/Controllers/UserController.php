<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_list = User::all();
        return view('admin.pages.users', compact('user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_user = User::create($request->all());

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
                $file_name = Storage::put('/avatar', $file);

                $new_user->avatar = $file_name;
                $new_user->save();
            }
        }
        return redirect()->route('users.edit', $new_user)->with('success', 'Tạo người dùng mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.pages.user-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::whereId($id)->delete();
        return redirect()
            ->route('admin.users')
            ->with('success', 'Đã xóa người dùng thành công');
    }
}
