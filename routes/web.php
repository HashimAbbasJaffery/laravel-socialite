<?php

use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\SlackController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
Route::get("/", function() {
    return view("welcome");
});

Route::get("logout", function() {
    Auth::logout();
    return redirect("/");
})->name("");


Route::get("/auth/{provider}/redirect", [OAuthController::class, "redirect"])->name("login");
Route::get("/auth/{provider}/callback", [OAuthController::class, "callback"]);

Route::get("/auth/logout", function() {
    Auth::logout();
    
    request()->session()->invalidate();

    request()->session()->regenerateToken();
    return redirect("/");
})->name("logout");

