<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

// USER ACCESSABLE ROUTES - Home Controller
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('homepage'); // for Homepage
});

// USER ACCESSABLE ROUTES - Blog Controller
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog'); // for Blog page
    Route::get('/blog/{post:slug}', 'single')->name('blog.single'); // for Blog single page
    Route::get('/blog/category/{category:slug}', 'category')->name('blog.category'); // for Category wise blog page
    Route::get('/blog/user/{user:username}', 'user')->name('blog.user'); // for User wise blog page
});

// USER ACCESSABLE ROUTES - User Controller
Route::controller(UserController::class)->group(function() {
    Route::get('/user/register', 'register')->name('user.register');
    Route::post('/user/register/store', 'store')->name('user.register.store');
    Route::get('/user/login', 'login')->name('user.login');
    Route::post('/user/login/authenticate', 'authenticate')->name('user.login.authenticate');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/user/profile', 'profile')->name('user.profile');
});

// ADMIN ACCESSABLE ROUTES
Route::middleware('isadmin')->group(function(){
    // User Registration
    Route::controller(UserController::class)->group(function() {
        Route::get('/dashboard/home', 'dashboard')->name('dashboard');
        Route::put('/user/update', 'update')->name('user.update');
        Route::get('user/all-users', 'index')->name('all.users');
        Route::get('user/create-user', 'create')->name('create.user');
        Route::post('user/create/store', 'create_store')->name('create.user.store');
        Route::get('user/{user}/edit', 'edit')->name('user.edit');
        Route::put('/user/{user}/update-user', 'update_user')->name('update.user');
        Route::delete('user/{user}/delete', 'delete')->name('user.delete');
    });
    // Post
    Route::controller(PostController::class)->group(function(){
        Route::get('posts/create', 'create')->name('post.create');
        Route::post('posts/store', 'store')->name('post.store');
        Route::get('posts/all-posts', 'index')->name('admin.all-posts');
        Route::get('posts/{post}', 'show')->name('admin.single-post');
        Route::get('posts/{post}/edit', 'edit')->name('post.edit');
        Route::put('posts/{post}/update', 'update')->name('post.update');
        Route::delete('posts/{post}/delete', 'delete')->name('post.delete');
    });
    // Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('posts/category/create', 'index')->name('admin.all-categories');
        Route::post('posts/category/store', 'store')->name('admin.category.store');
        Route::get('posts/category/{category}/edit', 'edit')->name('admin.category.edit');
        Route::put('posts/category/{category}/update', 'update')->name('admin.category.update');
        Route::delete('posts/category/{category}/delete', 'delete')->name('admin.category.delete');
    });
    // Tag
    Route::controller(TagController::class)->group(function(){
        Route::get('posts/tag/all', 'index')->name('admin.all-tags');
        Route::post('posts/tag/store', 'store')->name('admin.tag.store');
        Route::get('posts/tag/{tag}/edit', 'edit')->name('admin.tag.edit');
        Route::put('posts/tag/{tag}/update', 'update')->name('admin.tag.update');
        Route::delete('posts/tag/{tag}/delete', 'delete')->name('admin.tag.delete');
    });
    // Customers
    Route::resources([
        'customers'  =>  CustomerController::class
    ]);
});
