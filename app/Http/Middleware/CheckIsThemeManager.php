<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIsThemeManager
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
        //for each role in the roles collection check if they have theme manager as one of them
        foreach (auth()->user()->roles as $role) {
            if($role->name == "Theme Manager") {
                return $next($request);
            }
        }

        session()->flash('status','Denied - You do not have permissions to access Theme Management');
        return redirect()->back();
        //dd(auth()->user()->roles); // empty or contain roles
    }

}
