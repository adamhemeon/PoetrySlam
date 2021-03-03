<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Compound;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // preventing someone who's not logged in from using the controller
        $this->middleware('isuseradmin');
    }

    /**
     * Show the main page for viewing admin users page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::has('roles')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::table('roles',)->get();

        return view('user.create', compact('roles'));
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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required|array|min:1'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //give roles
        $user->roles()->sync($request->roles);

        session()->flash('status','Success - User ' .  $user->name . ' created successfully.');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts = $user->posts()->get()->sortByDesc('updated_at');
        return view('user.show')->with(compact('user'))->with(compact('posts')); //route model binding
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = DB::table('roles',)->get();
        //dd($user);
        return view('user.edit')->with(compact('user'))->with(compact('roles'));  //route model binding
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'roles' => 'required|array|min:1'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        //give roles
        $user->roles()->sync($request->roles);

        session()->flash('status','Success - User ' .  $user->name . ' updated successfully.');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Request $request, User $user)
    {
        DB::table('users')
            ->where('id',$user->id)
            ->update(['deleted_by' => $request->deletedBy]);

        $user->delete();

        session()->flash('status','Success - User ' .  $user->name . ' deleted successfully.');
        return redirect(route('users.index'));
    }
}
