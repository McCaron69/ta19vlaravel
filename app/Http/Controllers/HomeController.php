<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function posts()
    {
        $posts = Post::latest()->paginate(16);

        return response()->view('posts', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function post(Post $post)
    {
        //$post = Post::findOrFail($id);
        return response()->view('post', compact('post'));
    }

    public function user(User $user) {
        $posts = $user->posts()->paginate(10);
        $posts_written = $user->posts()->count();
        $likes_given = $user->likes()->count();
        $comments_written = $user->comments()->count();
        $likes_gained = $user->likesOnWrittenPosts()->count();
        $comments_gained = $user->commentsOnWrittenPosts()->count();

        return response()->view('user', compact('user',
                                                'posts', 
                                                'posts_written', 
                                                'likes_given', 
                                                'comments_written', 
                                                'likes_gained', 
                                                'comments_gained'));
    }
}
