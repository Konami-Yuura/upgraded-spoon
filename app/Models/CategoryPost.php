<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    // $this->user->save();   ->PATCH
    // $user->create([])      ->BATCH

    /* 
        USED FOR UPDATE METHOD
        PUT (replace)
        PATCH (update a single or any entry of the table in db)
    */ 

    protected $table = 'category_post';
    protected $fillable = ['category_id', 'post_id'];
    public $timestamps = false;

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
