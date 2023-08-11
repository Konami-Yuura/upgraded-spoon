<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/suggestions', [HomeController::class, 'suggestions'])->name('suggestions');
    // this route all serve the users>posts>create.blade
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    // this will save the post in the db
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    // this route will serve the users>posts>show.blade
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');
    // this route will serve the user>posts>edit.blade
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    // this route will update the post existing data
    Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('post.update');
    // this route will delete a single post
    Route::delete('/post/{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');

    // COMMENT
    // this route will create a new comment in post
    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');
    // this route will delete a single comment
    Route::delete('/comment/{id}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');

    // PROFILE
    // this route will serve the users>profile>show.blade
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    // this route will serve the users>profile>edit.blade
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // this route will update the data of the login user
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // this route will serve the users>profile>followers.blade.php
    Route::get('profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    //
    Route::get('profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');

    // Like
    // this route will save/store the like
    Route::post('/like/{post_id}/store', [LikeController::class, 'store'])->name('like.store');
    //this route will remove the like
    Route::delete('/like/{post_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');

    //Follow
    //  this route will save/store the follow
    Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
    //  this route will unfollow the user
    Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');
});
