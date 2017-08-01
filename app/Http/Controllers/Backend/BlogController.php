<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Blog;
use App\BlogComment;
use App\BlogReply;
use DB;
use App\Jobs\MailTest;
use Redis;

class BlogController extends Controller
{
	public function index()
	{
		$blogs = DB::table('blogs')
				->where('blogs.user_id', Auth::user()->id)
				->get();

		// $redis = new Redis;
		// $redis->connect('127.0.0.1', 6379);
		// $blog = $redis->set('blog', json_encode(Auth::user()->blogs));
		return view('backend.blog.index', compact('blogs'));
	}

	public function create()
	{
		return view('backend.blog.create');
	}

	public function store(Request $request)
	{	
		$data = array(
			'user_id' => Auth::user()->id,
			'title' => $request->title,
			'content' => $request->content,
			);

		DB::table('blogs')
			->insert($data);

		$job = (new MailTest($request->title, $request->content));
        dispatch($job);

    	return redirect('backend/blog');
	}

	public function show($blog)
	{
		$blog = DB::table('blogs')
				->where('blogs.id', $blog)
				->first();

		$comments = DB::table('blog_comments')
				->where('blog_comments.blog_id', $blog->id)
				->get();

		$replies = DB::table('blog_comments')
				->where('blog_comments.blog_id', $blog->id)
				->join('blog_replies', 'blog_comments.id', '=', 'blog_replies.blog_comment_id')
				->get();

		return view('backend.blog.show', compact('blog','comments','replies'));
	}

	public function edit($blog)
	{
		$blog = DB::table('blogs')
				->where('blogs.id', $blog)
				->first();

		return view('backend.blog.edit', compact('blog'));
	}

	public function update(Request $request,Blog $blog)
	{
		$data = array(
				'title' => $request->title,
				'content' => $request->content,
				'updated_at' => Carbon::now('Asia/Taipei'),
			);

		DB::table('blogs')
				->where('blogs.id', $blog->id)
				->update($data);

		return redirect('/backend/blog/'.$blog->id);
	}

	public function destroy(Blog $blog)
	{
		DB::table('blogs')
				->where('blogs.id', $blog->id)
				->delete();

		return redirect('/backend/blog/');
	}

	//--------------BlogComment--------------

	public function comment_store(Request $request,Blog $blog)
	{
		$data = array(
				'blog_id' => $blog->id,
				'name' => Auth::user()->name,
				'content' => $request->content,
				'created_at' => Carbon::now('Asia/Taipei'),
			);

		DB::table('blog_comments')
				->insert($data);

		return redirect('/backend/blog/'.$blog->id);
	}

	public function comment_edit(Blog $blog,BlogComment $comment)
	{
		return view('backend.blog.comment_edit',compact('blog','comment'));
	}

	public function comment_update(Request $request,Blog $blog,BlogComment $comment)
	{
		$data = array(
				'name' => $request->name,
				'content' => $request->content,
				'updated_at' => Carbon::now('Asia/Taipei'),
			);

		DB::table('blog_comments')
				->where('blog_comments.id', $comment->id)
				->update($data);

		return redirect('/backend/blog/'.$blog->id);
	}

	public function comment_destroy(Blog $blog,BlogComment $comment)
	{
		DB::table('blog_comments')
				->where('blog_comments.id', $comment->id)
				->delete();

		return redirect('/backend/blog/'.$blog->id);
	}

	//------------CommentReply-------------

	public function reply_create(Blog $blog,BlogComment $comment)
	{
		$replies = DB::table('blog_replies')
				->where('blog_replies.blog_comment_id', $comment->id)
				->get();

		return view('backend.blog.reply',compact('blog','comment','replies'));
	}

	public function reply_store(Request $request,Blog $blog,BlogComment $comment)
	{
		$data = array(
				'blog_comment_id' => $comment->id,
				'name' => Auth::user()->name,
				'content' => $request->content,
				'created_at' => Carbon::now('Asia/Taipei'),
			);
		
		DB::table('blog_replies')
				->insert($data);

		return redirect('/backend/blog/'.$blog->id);
	}

	public function reply_edit(Blog $blog,BlogComment $comment,BlogReply $reply)
	{
		return view('backend.blog.reply_edit',compact('blog','comment','reply'));
	}

	public function reply_update(Request $request,Blog $blog,BlogComment $comment,BlogReply $reply)
	{
		$data = array(
				'name' => $request->name,
				'content' => $request->content,
				'updated_at' => Carbon::now('Asia/Taipei'),
			);

		DB::table('blog_replies')
				->where('blog_replies.id', $reply->id)
				->update($data);

		return redirect('/backend/blog/'.$blog->id);
	}

	public function reply_destroy(Blog $blog,BlogComment $comment,BlogReply $reply)
	{
		DB::table('blog_replies')
				->where('blog_replies.id', $reply->id)
				->delete();

		return redirect('/backend/blog/'.$blog->id);
	}






}