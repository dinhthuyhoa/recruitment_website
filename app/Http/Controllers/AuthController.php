<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function login_admin()
    {
        return view('admin.auth.login');
    }

    public function submit_login_admin()
    {
        return view('admin.auth.login');
    }
}
