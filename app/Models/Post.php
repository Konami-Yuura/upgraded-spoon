<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    // A post belongs to a user
    // To get owner of the post
    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    // this will be use to get the categories under a post
    public function categoryPost() {
        return $this->hasMany(CategoryPost::class);
    }

    // get the comments of the single post
    public function comments() {

        // To get the latest comment append the latest() to the end of the return statement of the relationship
        return $this->hasMany(Comment::class)->latest();
    }

    // To get the likes of a post
    public function likes() {
        return $this->hasMany(Like::class);
    }

    //return TRUE id the Auth user already likes the post
    public function isLiked() {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}


