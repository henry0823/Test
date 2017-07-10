<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
use DB;

class UserController extends Controller
{	
	public function index($user)
	{	
		$user = session('user');

		$profile = DB::table('users')
				->where('users.name', $user->name)
				->join('profiles', 'profiles.user_id', '=', 'users.id')
				->first();

		return view('guest.user.index', compact('user','profile'));
	}
}
