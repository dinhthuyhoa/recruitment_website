<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'email' =>  $request->username,
            'password' => $request->password
        ];

        $login_phone = [
            'phone' => $request->username,
            'password' => $request->password
        ];


        if ((Auth::attempt($login_email, $remember) || Auth::attempt($login_phone, $remember))) {
            if (!(Auth::check() &&
                (Auth::user()->role == UserRole::Administrator || Auth::user()->role == UserRole::Recruiter || Auth::user()->role == UserRole::SubAdmin)
            )) {
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
    public function login_frontend()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('frontend.auth.login');
    }
    public function submit_login_frontend(Request $request)
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
            return redirect()->route('home');
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
}
