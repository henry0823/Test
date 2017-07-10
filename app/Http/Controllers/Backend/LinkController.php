<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Link;
use DB;

class LinkController extends Controller
{
    public function index()
    {
        $links = DB::table('links')
                ->where('links.user_id', Auth::user()->id)
                ->get();

        return view('backend.link.index',compact('links'));
    }

    public function create()
    {
        return view('backend.link.create');
    }

    public function store(Request $request)
    {
        $check = DB::table('users')
                ->where('users.email', $request->email)
                ->first();

        if($check == null)
        {
            return view('backend.error');
        }
        else
        {
            $user = DB::table('users')
                    ->where('users.email', $request->email)
                    ->first();

            $data = array(
                    'user_id' => Auth::user()->id,
                    'name' => $user->name,
                    'email' => $request->email,
                    'created_at' => Carbon::now('Asia/Taipei'),
                );

            DB::table('links')
                ->insert($data);                

            return redirect('/backend/link');
        }
    }


    public function link()
    {
        $links = DB::table('links')
                ->where('links.user_id', Auth::user()->id)
                ->get();

        return view('backend.link.destroy', compact('links'));
    }

    public function destroy(Request $request)
    {
        DB::table('links')
            ->where('name', $request->name)
            ->delete();
            
        return redirect('/backend/link');
    }




}
