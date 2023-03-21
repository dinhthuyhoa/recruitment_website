<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

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
            'email' =>  $request->username,
            'password' => $request->password
        ];

        $login_phone = [
            'phone' => $request->username,
            'password' => $request->password
        ];


        if ((Auth::attempt($login_email, $remember) || Auth::attempt($login_phone, $remember))) {
            return back();
        } else {
            return back()->with('error', 'Tài khoản hoặc mật khẩu sai!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }
}
