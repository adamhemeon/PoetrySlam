<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIsUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //for each role in the roles collection check if they have user admin as one of them
        foreach (auth()->user()->roles as $role) {
            if($role->name == "User Administrator") {
                return $next($request);
            }
        }

        session()->flash('status','Denied - You do not have permissions to access User Management');
        return redirect()->back();
        //dd(auth()->user()->roles); // empty or contain roles
    }
}
