<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogReply extends Model
{
    public function blog_comment()
    {
        return $this->belongTo('App\BlogComment');
    }
}
