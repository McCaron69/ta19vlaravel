<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'title'];
//    public function getTitleAttribute($value){
//        return ucfirst($value) . '.';
//    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }

    public static function commentsInCollection($collection) {
        $commentsCount = 0;
        foreach ($collection as $item) {
            $commentsCount += $item->comments()->count();
        }
        return $commentsCount;
    }

    public static function userPostsTotalComments($user_id) {
        return Post::commentsInCollection(Post::where('user_id', $user_id)->get());
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public static function likesInCollection($collection) {
        $likesCount = 0;
        foreach ($collection as $item) {
            $likesCount += $item->likes()->count();
        }
        return $likesCount;
    }

    public static function userPostsTotalLikes($user_id) {
        return Post::likesInCollection(Post::where('user_id', $user_id)->get());
    }

    public function getAuthHasLikedAttribute(){
        if(auth()->check()) {
            return $this->likes()->where('user_id', auth()->user()->id)->exists();
        }
        return false;
    }

    public function getSnippetAttribute(){
        return explode("\n\n", $this->body)[0];
    }

    public function getDisplayBodyAttribute() {
        return nl2br($this->body);
    }

    protected static function booted()
    {
        static::deleted(function ($post) {
            File::delete(public_path($post->image_path));
        });
    }
}
