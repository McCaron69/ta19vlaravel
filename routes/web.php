<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/posts', [HomeController::class, 'posts']);
Route::get('/posts/{post}', [HomeController::class, 'post'])->whereNumber('post')->name('post');

//Route::get('/admin/posts', [PostController::class, 'index']);
//Route::get('/admin/posts/create', [PostController::class, 'create']);
//Route::post('/admin/posts', [PostController::class, 'store']);
//Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit']);
//Route::post('/admin/posts/{post}', [PostController::class, 'update']);
//Route::get('/admin/posts/{post}/delete', [PostController::class, 'destroy']);


Route::middleware(['auth'])->group(function() {
    Route::resource('/admin/posts', PostController::class);
    Route::post('/post/{post}', [\App\Http\Controllers\CommentController::class, 'store']);
    Route::get('/post/{post}/like', [\App\Http\Controllers\LikeController::class, 'store'])->name('post.like');
    Route::get('/user/profile', function() {
        return view('profile');
    })->name('profile');
    Route::get('/user/posts', function() {
        $posts = Post::where('user_id', auth()->user()->id)->paginate(10);
        $likes_total = Post::userPostsTotalLikes(auth()->user()->id);
        $comments_total = Post::userPostsTotalComments(auth()->user()->id);
        return view('user-posts', compact('posts', 'likes_total', 'comments_total'));
    })->name('user-posts');
});
