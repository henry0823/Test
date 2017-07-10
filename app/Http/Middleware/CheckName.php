<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Session;
use DB;

class CheckName
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  
        $check = DB::table('users')
                ->where('users.name', $request->user)        
                ->first();

        session(['user' => $check]);

        if($check == null)
        {
            return redirect('/error');
        }
        elseif($check->name == Auth::user()->name)
        {
            return redirect('/');
        }

        return $next($request);
    }
}
