<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ======================================== ADMIN ===========================================
    public function login_admin()
    {
        if (
            Auth::check() &&
            (Auth::user()->role == UserRole::Administrator || Auth::user()->role == UserRole::Recruiter || Auth::user()->role == UserRole::SubAdmin)
        ) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function submit_login_admin(Request $request)
    {
        $remember = ($request->remember) ? true : false;

        $login_email = [
            'email' => $request->username,
            'password' => $request->password,
        ];

        $login_phone = [
            'phone' => $request->username,
            'password' => $request->password,
        ];

        if ((Auth::attempt($login_email, $remember) || Auth::attempt($login_phone, $remember))) {
            if (Auth::check() && Auth::user()->status == 'Pendding') {
                Auth::logout();
                return back()->with('error', 'Vui lòng chờ Admin phê duyệt tài khoản!');
            }

            if (
                !(Auth::check() &&
                    (Auth::user()->role == UserRole::Administrator || Auth::user()->role == UserRole::Recruiter || Auth::user()->role == UserRole::SubAdmin)
                )
            ) {
                Auth::logout();
                return back()->with('error', 'Tài khoản hoặc mật khẩu sai!');
            }
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('error', 'Tài khoản hoặc mật khẩu sai!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }

    // ======================================== FRONTEND ===========================================
    public function login_frontend(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $redirect_to = $request->url;

        return view('frontend.auth.login', compact('redirect_to'));
    }

    public function submit_login_frontend(Request $request)
{
    $remember = ($request->remember) ? true : false;

    $login_email = [
        'email' => $request->username,
        'password' => $request->password
    ];

    $login_phone = [
        'phone' => $request->username,
        'password' => $request->password
    ];

    if ((Auth::attempt($login_email, $remember) || Auth::attempt($login_phone, $remember))) {
        $user = Auth::user();
        // dd(Auth::user());
        // Check if the user's role is 'user' and status is 'active'.
        if ($user->status == 'Active') {
            if ($request->redirect_to) {
                return redirect($request->redirect_to);
            } else {
                return redirect()->route('home');
            }

        } elseif ($user->status == 'Pendding') {
            Auth::logout();

            if ($request->redirect_to) {
                return redirect($request->redirect_to)->with('error', 'Vui lòng chờ Admin phê duyệt tài khoản!');
            } else {
                return redirect()->route('home')->with('error', 'Vui lòng chờ Admin phê duyệt tài khoản!');
            }
        } else {
            Auth::logout();
            return back()->with('error', 'Tài khoản hoặc mật khẩu sai!');
        }
    } else {
        return back()->with('error', 'Tài khoản hoặc mật khẩu sai!');
    }
}
    public function register_frontend()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('frontend.auth.register');
    }

    public function register_recruiter_frontend()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('frontend.auth.register-recruiter');
    }

    public function submit_register_frontend(Request $request)
    {
        if ($request->password != $request->password_verify) {
            return back()->with('error', 'Mật khẩu xác nhận không trùng khớp !!!');
        }

        $new_user = User::create([
            'name' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        if (isset($request->recruiter) && $request->recruiter != '') {
            $new_user->update([
                'role' => UserRole::Recruiter,
                'status' => 'Pending',
            ]);
            session(['user_id' => $new_user['id']]);
            return redirect()->route('register.checkout')->with('success', 'Đăng ký thành công, chờ admin duyệt tài khoản!');
        }
        
        else {
            $login_email = [
                'email' => $request->phone,
                'password' => $request->password,
            ];
    
            $login_phone = [
                'phone' => $request->phone,
                'password' => $request->password
            ];
    
    
            if ((Auth::attempt($login_email) || Auth::attempt($login_phone))) {
                return redirect()->route('profile', Auth::user()->id)->with('success', 'Đăng ký thành công, hãy cập nhật hồ sơ cá nhân nhé!');
            } else {
                return redirect()->route('login')->with('success', 'Đăng ký thành công, hãy đăng nhập để vào hệ thống!');
            }
        }
    }
}
