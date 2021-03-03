<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanEditPost
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
        // Below code would allow moderators to also edit posts
//        foreach (auth()->user()->roles as $role) {
//            if($role->name == "Moderator") {
//                return $next($request);
//            }
//        }

        if(Auth::id() == $request->post->created_by){
            return $next($request);
        }

        session()->flash('status','Denied - You do not have permissions to edit other users\' posts');
        return redirect()->back();
    }
}
