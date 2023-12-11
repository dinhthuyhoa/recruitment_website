<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
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
            $message_error = "Tài khoản hoặc mật khẩu sai!";
            return view('admin.auth.login', compact('message_error'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
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
        // dd($user->status);
        if ($user->status == 'Active') {
            if ($request->redirect_to) {
                if($user->role == 'recruiter'){
                    return redirect()->route('home');
                }
                else{
                    return redirect($request->redirect_to);
                } 
            } else {
                return redirect()->route('home');
            }

        } elseif ($user->status == 'Pending') {
            // Auth::logout();
            session(['user_id' => $user->id]);
            if ($request->redirect_to) {
                // return redirect($request->redirect_to)->with('error', 'Vui lòng chờ Admin phê duyệt tài khoản!');
                return redirect($request->redirect_to)->route('register.checkout');

            } else {
                // dd(3);
                return redirect($request->redirect_to)->route('register.checkout');

                // return redirect()->route('home')->with('error', 'Vui lòng chờ Admin phê duyệt tài khoản!');
            }
        } else {
            Auth::logout();
            return back()->with('error', 'Tài khoản hoặc mật khẩu sai!');
        }
    } else {
        $message_error = "Tài khoản hoặc mật khẩu sai!";
        return view('frontend.auth.login', compact('message_error'));
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
        if (isset($request->recruiter) && $request->recruiter != '') {
            $validator = \Validator::make($request->all(), [
                'fullname' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore(auth()->user()), 
                ],
                'address' => 'required|string|max:255',
                'password' => 'required|string|min:6',
                'password_verify' => 'required|string|same:password',
            ]);
            $existingRecruiterPending = User::where(function ($query) use ($request) {
                $query->where('phone', $request->phone)
                    ->orWhere('email', $request->email);
            })->where('role', UserRole::Recruiter)
                ->where('status', 'Pending')
                ->first();
            // dd($existingRecruiterPending);
            if ($existingRecruiterPending) {
                $errorMessagePending = 'Chưa hoàn thành quá trình đăng ký. Vui lòng đăng nhập.';
                return view('frontend.auth.login', compact('errorMessagePending'));
            }

            $existingPhone = User::where('phone', $request->phone)->first();
            $existingEmail = User::where('email', $request->email)->first();
        
            if ($existingPhone && $existingEmail) {
                // Both phone and email exist
                $errorMessagePhone = 'Số điện thoại đã tồn tại trong hệ thống!';
                $errorMessageMail = 'Email đã tồn tại trong hệ thống!';
                return view('frontend.auth.register-recruiter', compact('errorMessagePhone', 'errorMessageMail'));
            }
            
            if ($existingPhone) {
                // Phone exists
                $errorMessagePhone = 'Số điện thoại đã tồn tại trong hệ thống!';
                return view('frontend.auth.register-recruiter', compact('errorMessagePhone'));
            }
            
            if ($existingEmail) {
                // Email exists
                $errorMessageMail = 'Email đã tồn tại trong hệ thống!';
                return view('frontend.auth.register-recruiter', compact('errorMessageMail'));
            }

            

            $new_user = User::create([
                'name' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'avatar' => 'https://previews.123rf.com/images/krustovin/krustovin1801/krustovin180100057/94300911-hombre-con-corbata-icono-plano-de-hombre-de-negocios-hombre-en-traje-de-negocios-avatar-del-hombre.jpg',
                'role' => UserRole::Recruiter,
                'status' => 'Pending',
            ]);
            session(['user_id' => $new_user['id']]);
            return redirect()->route('register.checkout')->with('success', 'Đăng ký thành công, chờ admin duyệt tài khoản!');
        }
        
    }
}
