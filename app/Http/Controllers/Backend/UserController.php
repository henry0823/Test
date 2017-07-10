<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use DB;

class UserController extends Controller
{
    public function index()
	{
		$user = DB::table('users')
				->where('id', Auth::user()->id)
				->first();

		$profile = DB::table('profiles')
					->where('user_id', Auth::user()->id)
					->first();

		return view('backend.user.index',compact('user','profile'));
	}

	public function create()
	{
		return view('backend.user.create');
	}

	public function store(Request $request)
	{
		$data = array(
				'user_id' => Auth::user()->id,
				'age' => $request->age,
				'sex' => $request->sex,
				'day' => $request->day,
				'address' => $request->address,
				'interest' => $request->interest,
				'self' => $request->self,
				'created_at' => Carbon::now('Asia/Taipei'),
			);
		//dd($data);
		DB::table('profiles')
				->insert($data);
		
		return redirect('/backend/user');
	}

	public function edit()
	{
		$user = DB::table('users')
				->where('id', Auth::user()->id)
				->first();

		$profile = DB::table('profiles')
				->where('user_id', Auth::user()->id)
				->first();

		return view('backend.user.edit',compact('user','profile'));
	}

	public function update(Request $request)
	{
		$data = array(
				'user_id' => Auth::user()->id,
				'age' => $request->age,
				'sex' => $request->sex,
				'day' => $request->day,
				'address' => $request->address,
				'interest' => $request->interest,
				'self' => $request->self,
				'updated_at' => Carbon::now('Asia/Taipei'),
			);

		DB::table('profiles')
			->where('user_id', Auth::user()->id)
			->update($data);

		return redirect('/backend/user');	
	}

	public function name_edit()
	{	
		$user = Auth::user();
		return view('backend.user.name_edit',compact('user'));
	}


	public function name_update(Request $request)
	{
		$data = array(
			'name' => $request->name
			);

		DB::table('users')
				->where('id', Auth::user()->id)
				->update($data);

		DB::table('links')
				->where('links.name', Auth::user()->name)
				->update($data);

		return redirect('/backend/user');	
	}






}
