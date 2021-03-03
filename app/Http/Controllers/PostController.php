<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // preventing someone who's not logged in from using the controller
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'message' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->author = $request->author;
        $post->message = $request->message;
        $post->created_by = auth()->user()->id;
        $post->save();

        return redirect(route('home'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'message' => 'required'
        ]);

        $post->title = $request->title;
        $post->author = $request->author;
        $post->message = $request->message;
        $post->save();

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        DB::table('posts')
            ->where('id',$post->id)
            ->update(['deleted_by' => Auth::user()->id]);

        $post->delete();

        return redirect(route('home'));
    }
}
