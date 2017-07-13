<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Blog;
use App\BlogComment;
use DB;

class BlogController extends Controller
{
	public function index($user)
	{	
		$user = session('user');

		$blogs = DB::table('users')
			->where('users.name', $user->name)
			->join('blogs', 'blogs.user_id', '=', 'users.id')
			->get();
				
		return view('guest.blog.index', compact('user', 'blogs'));			
	}

	public function show($user, Blog $blog)
	{
		$user = session('user');

		$comments = DB::table('blog_comments')
				->where('blog_comments.blog_id', $blog->id)
				->get();

		$replies = DB::table('blog_comments')
				->where('blog_comments.blog_id', $blog->id)
				->join('blog_replies', 'blog_comments.id', '=', 'blog_replies.blog_comment_id')
				->get();

		return view('guest.blog.show',compact('user','blog','comments','replies'));
	}

	public function comment_store(Request $request, $user, Blog $blog)
	{
		$data = array(
				'blog_id' => $blog->id,
				'name' => Auth::user()->name,
				'content' => $request->content,
				'created_at' => Carbon::now('Asia/Taipei'),
			);

		DB::table('blog_comments')
				->insert($data);

		return redirect('/'.$user.'/blog/'.$blog->id);
	}

	public function reply_create($user,Blog $blog,BlogComment $comment)
	{
		$user = session('user');

		$replies = DB::table('blog_replies')
			->where('blog_replies.blog_comment_id', $comment->id)
			->get();

		return view('guest.blog.reply',compact('user','blog','comment','replies'));
	}

	public function reply_store(Request $request,$user,Blog $blog,BlogComment $comment)
	{
		$data = array(
				'blog_comment_id' => $comment->id,
				'name' => Auth::user()->name,
				'content' => $request->content,
				'created_at' => Carbon::now('Asia/Taipei'),
			);
		
		DB::table('blog_replies')
				->insert($data);

		return redirect('/'.$user.'/blog/'.$blog->id);
	}



}
