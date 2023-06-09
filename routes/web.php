<?php

use App\Events\ChatEvent;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostFavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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
Route::post('/reactions', [ReactController::class, 'reactions'])->name('reactions');

// User Profile
Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

// Ckeditor
Route::post('image-upload', [HomeController::class, 'storeImage'])->name('image.upload');

// Frontend Auth
Route::get('/login', [AuthController::class, 'login_frontend'])->name('login');
Route::post('/login', [AuthController::class, 'submit_login_frontend'])->name('login.submit');
Route::get('/register', [AuthController::class, 'register_frontend'])->name('register');
Route::get('/register/recruiter', [AuthController::class, 'register_recruiter_frontend'])->name('register.recruiter');
Route::post('/register', [AuthController::class, 'submit_register_frontend'])->name('register.submit');

// Frontend Apply
Route::post('/job-apply/apply', [ApplyController::class, 'candidate_apply'])->name('job_apply.apply');

// Frontend Recruitment Post
Route::group(['prefix' => 'posts/recruitment'], function () {
    Route::get('/list', [PostController::class, 'recruitment_post_list'])->name('posts.recruitment.list');
    Route::get('/details/{id}', [PostController::class, 'recruitment_post_details'])->name('posts.recruitment.details');
});

Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add');
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');

// Frontend News Post
Route::group(['prefix' => 'posts/news'], function () {
    Route::get('/list', [PostController::class, 'news_post_list'])->name('posts.news.list');
    Route::get('/details/{id}', [PostController::class, 'news_post_details'])->name('posts.news.details');
});

// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/login', [AuthController::class, 'login_admin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'submit_login_admin'])->name('admin.login.submit');

    Route::group(['middleware' => 'admin'], function () {

        Route::resource('/users', UserController::class);
        Route::get('/job-apply/list', [ApplyController::class, 'list'])->name('admin.job_apply.list');
        Route::get('/job-apply/edit/{id}', [ApplyController::class, 'edit'])->name('admin.job_apply.edit');
        Route::post('/job-apply/edit/{id}/update_status', [ApplyController::class, 'update_status'])->name('admin.job_apply.update_status');

        // Recruitment Post
        Route::group(['prefix' => 'posts/recruitment'], function () {
            Route::get('/', [PostController::class, 'admin_recruitment_post_list'])->name('admin.posts.recruitment.list');
            Route::get('/create', [PostController::class, 'admin_recruitment_post_create'])->name('admin.posts.recruitment.create');
            Route::post('/create', [PostController::class, 'admin_recruitment_post_store'])->name('admin.posts.recruitment.store');
            Route::get('/{id}/edit', [PostController::class, 'admin_recruitment_post_edit'])->name('admin.posts.recruitment.edit');
            Route::post('/{id}/edit', [PostController::class, 'admin_recruitment_post_update'])->name('admin.posts.recruitment.update');
            Route::delete('/{id}/delete', [PostController::class, 'admin_recruitment_post_delete'])->name('admin.posts.recruitment.delete');
        });
        // News Post
        Route::group(['prefix' => 'posts/news'], function () {
            Route::get('/', [PostController::class, 'admin_news_post_list'])->name('admin.posts.news.list');
            Route::get('/create', [PostController::class, 'admin_news_post_create'])->name('admin.posts.news.create');
            Route::post('/create', [PostController::class, 'admin_news_post_store'])->name('admin.posts.news.store');
            Route::get('/{id}/edit', [PostController::class, 'admin_news_post_edit'])->name('admin.posts.news.edit');
            Route::post('/{id}/edit', [PostController::class, 'admin_news_post_update'])->name('admin.posts.news.update');
            Route::delete('/{id}/delete', [PostController::class, 'admin_news_post_delete'])->name('admin.posts.news.delete');
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
