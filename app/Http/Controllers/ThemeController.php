<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // preventing someone who's not logged in from using the controller
        $this->middleware('isthememanager'); // only theme managers may access this controller
    }

    /**
     * Show the main page for viewing themes page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $themes = Theme::all()->sortBy('name');
        return view('theme.index', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        // Must be unique but may ignore already soft deleted themes
        $request->validate([
            'name' => ['required', 'min:3', Rule::unique('themes')->ignore($request->id)->whereNull('deleted_at')],
            'cdn_url' => ['required', 'active_url', Rule::unique('themes')->ignore($request->id)->whereNull('deleted_at')]
        ]);

        $theme = new Theme;
        $theme->name = $request->name;
        $theme->cdn_url = $request->cdn_url;
        $theme->created_by = auth()->user()->id;
        $theme->save();

        session()->flash('status','Success - Theme ' .  $theme->name . ' created successfully.');
        return redirect(route('themes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        return view('theme.show', compact('theme')); //route model binding
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        return view('theme.edit', compact('theme'));  //route model binding
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Theme $theme)
    {
        // Must be unique but may ignore already soft deleted themes
        $request->validate([
            'name' => ['required', 'min:3', Rule::unique('themes')->ignore($theme->id)->whereNull('deleted_at')],
            'cdn_url' => ['required', 'active_url', Rule::unique('themes')->ignore($theme->id)->whereNull('deleted_at')]
        ]);

        $theme->name = $request->name;
        $theme->cdn_url = $request->cdn_url;
        $theme->save();

        session()->flash('status','Success - Theme ' .  $theme->name . ' updated successfully.');
        return redirect(route('themes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Theme $theme
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Request $request, Theme $theme)
    {
        DB::table('themes')
            ->where('id',$theme->id)
            ->update(['deleted_by' => $request->deletedBy]);

        $theme->delete();

        session()->flash('status','Success - Theme ' .  $theme->name . ' deleted successfully.');
        return redirect(route('themes.index'));
    }
}
