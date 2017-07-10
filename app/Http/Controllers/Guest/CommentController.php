<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Comment;
use DB;

class CommentController extends Controller
{	
	public function index($user)
	{	
		$user = session('user');

		$comments = DB::table('comments')
				->where('comments.user_id', $user->id)
				->get();

		$replies = DB::table('comments')
				->where('comments.user_id', $user->id)
				->join('comment_replies', 'comment_replies.comment_id', '=', 'comments.id')
				->get();

		return view('guest.comment.index', compact('user','comments','replies'));
	}

	public function store(Request $request,$user)
	{
		$user = DB::table('users')
				->where('users.name', $user)
				->first();

		$data = array(
				'user_id' => $user->id,
				'name' => Auth::user()->name,
				'content' => $request->content,
				'created_at' => Carbon::now('Asia/Taipei')
			);

		DB::table('comments')
				->insert($data);

		return redirect('/'.$user->name.'/comment');
	}	

	public function reply_create($user, Comment $comment)
	{
		$user = session('user');
	
		$replies = DB::table('comment_replies')
            ->where('comment_replies.comment_id', $comment->id)
            ->get();
                
		return view('guest.comment.reply',compact('user','comment','replies'));
	}

	public function reply_store(Request $request, $user, Comment $comment)
	{
		$data = array(
				'comment_id' => $comment->id,
				'name' => Auth::user()->name,
				'content' => $request->content,
				'created_at' => Carbon::now('Asia/Taipei')
			);

		DB::table('comment_replies')
				->insert($data);

		return redirect('/'.$user.'/comment');
	}










}
