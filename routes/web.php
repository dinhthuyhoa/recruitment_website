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

Route::get('/', function () {
    return view('frontend.pages.home');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/login', [AuthController::class, 'login_admin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'submit_login_admin'])->name('admin.login.submit');
    Route::resource('/users', UserController::class);
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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
