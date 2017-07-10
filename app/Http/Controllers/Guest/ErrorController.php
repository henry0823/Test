<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class ErrorController extends Controller
{	
	public function index()
	{	
		return view('guest.error');
	}
}
