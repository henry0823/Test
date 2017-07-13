<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoList;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function list($sport, $tw)
    {
        dd($sport,$tw);
        return view('live',compact('sport', 'tw'));
    }

}
