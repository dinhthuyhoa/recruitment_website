<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostFavoriteController;
use App\Http\Controllers\UserController;
use App\Models\PostFavorite;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/change-post-favorite', [PostFavoriteController::class, 'change_post_favorite'])->name('change_post_favorite');

// Ckeditor
Route::post('image-upload', [HomeController::class, 'storeImage'])->name('image.upload');

// Frontend
Route::get('/login', [AuthController::class, 'login_frontend'])->name('login');
Route::post('/login', [AuthController::class, 'submit_login_frontend'])->name('login.submit');
Route::get('/register', [AuthController::class, 'register_frontend'])->name('register');
Route::post('/job-apply/apply', [ApplyController::class, 'candidate_apply'])->name('job_apply.apply');


// Frontend post details
Route::group(['prefix' => 'posts/recruitment'], function () {
    Route::get('/{id}', [PostController::class, 'recruitment_post_details'])->name('posts.recruitment.details');
});

// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/login', [AuthController::class, 'login_admin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'submit_login_admin'])->name('admin.login.submit');

    Route::group(['middleware' => 'admin'], function () {

        Route::resource('/users', UserController::class);
        Route::get('/job-apply/list', [ApplyController::class, 'list'])->name('admin.job_apply.list');

        // Recruitment Post
        Route::group(['prefix' => 'posts/recruitment'], function () {
            Route::get('/', [PostController::class, 'recruitment_post_list'])->name('admin.posts.recruitment.list');
            Route::get('/create', [PostController::class, 'recruitment_post_create'])->name('admin.posts.recruitment.create');
            Route::post('/create', [PostController::class, 'recruitment_post_store'])->name('admin.posts.recruitment.store');
            Route::get('/{id}/edit', [PostController::class, 'recruitment_post_edit'])->name('admin.posts.recruitment.edit');
            Route::post('/{id}/edit', [PostController::class, 'recruitment_post_update'])->name('admin.posts.recruitment.update');
            Route::delete('/{id}/delete', [PostController::class, 'recruitment_post_delete'])->name('admin.posts.recruitment.delete');
        });
        // News Post
        Route::group(['prefix' => 'posts/news'], function () {
            Route::get('/', [PostController::class, 'news_post_list'])->name('admin.posts.news.list');
            Route::get('/create', [PostController::class, 'news_post_create'])->name('admin.posts.news.create');
            Route::post('/create', [PostController::class, 'news_post_store'])->name('admin.posts.news.store');
            Route::get('/{id}/edit', [PostController::class, 'news_post_edit'])->name('admin.posts.news.edit');
            Route::post('/{id}/edit', [PostController::class, 'news_post_update'])->name('admin.posts.news.update');
            Route::delete('/{id}/delete', [PostController::class, 'news_post_delete'])->name('admin.posts.news.delete');
        });
    });
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