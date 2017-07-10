<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Link;
use DB;

class LinkController extends Controller
{	
	public function index($user)
	{	
		$user = session('user');

		$links = DB::table('links')
				->where('links.user_id', $user->id)
				->get();
				
		return view('guest.link.index', compact('user','links'));
	}
}
