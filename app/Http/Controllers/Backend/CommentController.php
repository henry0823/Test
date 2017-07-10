<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Comment;
use App\CommentReply;
use DB;

class CommentController extends Controller
{
    public function index()
    {
    	$user = DB::table('users')
    			->where('users.id', Auth::user()->id)
    			->first();

    	$comments = DB::table('comments')
    			->where('comments.user_id', Auth::user()->id)
    			->get();

    	$replies = DB::table('comments')
    			->where('comments.user_id', Auth::user()->id)
    			->join('comment_replies', 'comment_replies.comment_id', '=', 'comments.id')
    			->get();

    	return view('backend.comment.index',compact('user','comments','replies'));
    }

    public function store(Request $request)
    {
        if(Auth::guest())
        {
            $data = array(
                    'user_id' => Auth::user()->id,
                    'name' => $request->name,
                    'content' => $request->content,
                    'created_at' => Carbon::now('Asia/Taipei'),
                );
        }   
        else
        {
            $data = array(
                    'user_id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'content' => $request->content,
                    'created_at' => Carbon::now('Asia/Taipei'),
                );
        }	

    	DB::table('comments')
    			->insert($data);

    	return redirect('/backend/comment');
    }

    public function edit(Comment $comment)
    {
    	return view('backend.comment.edit',compact('comment'));
    }

    public function update(Request $request,Comment $comment)
    {
    	$data = array(
    			'name' => $request->name,
    			'content' => $request->content,
    			'updated_at' => Carbon::now('Asia/Taipei'),
    		);

    	DB::table('comments')
    			->where('comments.id', $comment->id)
    			->update($data);

    	return redirect('backend/comment');
    }

    public function destroy(Comment $comment)
    {
    	DB::table('comments')
    			->where('comments.id', $comment->id)
    			->delete();

    	return redirect('/backend/comment');
    }

    //-------------Reply--------------

    public function reply_create(Comment $comment)
    {
        $replies = DB::table('comment_replies')
                ->where('comment_replies.comment_id', $comment->id)
                ->get();

    	return view('backend.comment.reply',compact('comment','replies'));
    }

    public function reply_store(Request $request,Comment $comment)
    {
    	$data = array(
    			'comment_id' => $comment->id,
    			'name' => Auth::user()->name,
    			'content' => $request->content,
    			'created_at' => Carbon::now('Asia/Taipei'),
    		);

    	DB::table('comment_replies')
    			->insert($data);

    	return redirect('/backend/comment');
    }

    public function reply_edit(Comment $comment,CommentReply $reply)
    {	
    	return view('backend.comment.reply_edit',compact('comment','reply'));
    }

    public function reply_update(Request $request,Comment $comment,CommentReply $reply)
    {
    	$data = array(
    			'name' => $request->name,
    			'content' => $request->content,
    			'updated_at' => Carbon::now('Asia/Taipei'),
    		);

    	DB::table('comment_replies')
    			->where('comment_replies.id', $reply->id)
    			->update($data);

    	return redirect('/backend/comment');
    }

    public function reply_destroy(Comment $comment,CommentReply $reply)
    {
    	DB::table('comment_replies')
    			->where('comment_replies.id', $reply->id)
    			->delete();

    	return redirect('backend/comment');
    }





}
