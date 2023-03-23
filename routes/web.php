<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// General
Route::get('/', function () {
    return view('frontend.pages.home');
})->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Frontend
Route::get('/login', [AuthController::class, 'login_frontend'])->name('login');
Route::post('/login', [AuthController::class, 'submit_login_frontend'])->name('login.submit');
Route::get('/register', [AuthController::class, 'register_frontend'])->name('register');

// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/login', [AuthController::class, 'login_admin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'submit_login_admin'])->name('admin.login.submit');
    Route::resource('/users', UserController::class);
});

// Change languages
Route::get('/languages/{language}', function ($language) {
    if (!in_array($language, ['en', 'vi'])) {
        // abort(404);
        return redirect('page-not-found');
    }
    App::setLocale($language);
    session()->put('web_recruitment_locale', $language);
    return redirect()->back();
})->name('settings.change-language');
