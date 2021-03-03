<?php

use App\Http\Controllers\ThemeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Push to Heroku: git subtree push --prefix FinalAssignment heroku master

Auth::routes();
Route::post('/redirect', function (Request $request) {
    if($request->theme == null){
        // remove cookie
        return redirect()->back()->withCookie(Cookie::forget('remembered_theme'));
    } else {
        return redirect()->back()->withCookie(cookie()->forever('remembered_theme',$request->theme));
    }
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Users
Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
Route::get('admin/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::patch('admin/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::post('admin/users', [UserController::class, 'store'])->name('users.store');
Route::get('admin/users/{user}', [UserController::class, 'show'])->name('users.show');

// Posts (no index or show route)
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('caneditpost');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::patch('posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');

// Themes
Route::get('admin/themes', [ThemeController::class, 'index'])->name('themes.index');
Route::get('admin/themes/create', [ThemeController::class, 'create'])->name('themes.create');
Route::get('admin/themes/{theme}/edit', [ThemeController::class, 'edit'])->name('themes.edit');
Route::delete('admin/themes/{theme}', [ThemeController::class, 'destroy'])->name('themes.destroy');
Route::patch('admin/themes/{theme}', [ThemeController::class, 'update'])->name('themes.update');
Route::post('admin/themes', [ThemeController::class, 'store'])->name('themes.store');
Route::get('admin/themes/{theme}', [ThemeController::class, 'show'])->name('themes.show');
