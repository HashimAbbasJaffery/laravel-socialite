<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirect() {
        return Socialite::driver("github")->redirect();
    }
    public function callback() {
        $github_user = Socialite::driver("github")->user();

        $user = null;
        DB::transaction(function() use ($github_user) {
            $user = User::updateOrCreate([
                "email" => $github_user->email
            ], [
                "name" => $github_user->name
            ]);

            $user->social()->create([
                "provider_id" => $github_user->id,
                "provider_token" => $github_user->token,
                "provider_refresh_token" => $github_user->refreshToken
            ]);
            Auth::login($user);
        });


        return redirect("/");
    }
}
