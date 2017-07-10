<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function user()
    {
        return $this->belongTo('App\User');
    }

    public function blog_comments()
    {
        return $this->hasMany('App\BlogComment');
    }
}
