<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongTo('App\User');
    }

    public function comment_replies()
    {
        return $this->hasMany('App\CommentReply');
    }
}
