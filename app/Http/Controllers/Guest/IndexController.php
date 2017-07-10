<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class IndexController extends Controller
{	
	public function index($user)
	{	
		return view('guest', compact('user'));			
	}
}
