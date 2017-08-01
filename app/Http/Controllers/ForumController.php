<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoList;

class ForumController extends Controller
{
	public function index()
	{
		return view('forum.index');
	}

	public function show()
	{
		return view('forum.show');
	}

	public function create(VideoList $lists)
	{
		return view('forum.create', compact('lists'));
	}

	public function store()
	{
		//
	}

	public function edit()
	{
		return view('forum.edit');
	}

	public function update()
	{
		//
	}

	public function delete()
	{
		//
	}
}
