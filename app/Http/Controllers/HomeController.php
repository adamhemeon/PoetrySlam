<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        $posts = $posts->sortByDesc('created_at');

        $roles = array();

        if(Auth::check()) {
            foreach (auth()->user()->roles as $role) {
                $roles[] = $role->name;
            }
        }

        return view('home')->with(compact('posts'))->with(compact('roles'));
    }
}
