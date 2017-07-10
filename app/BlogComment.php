<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    public function blog()
    {
        return $this->belongTo('App\Blog');
    }

    public function blog_replies()
    {
        return $this->hasMany('App\BlogReply');
    }
}
