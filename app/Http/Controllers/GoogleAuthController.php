<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver("google")->redirect();
    }

    public function callback() {
        $google_user = Socialite::driver("google")->user();

        $user = null;
        DB::transaction(function() use ($google_user) {
            $user = User::updateOrCreate([
                "email" => $google_user->email
            ], [
                "name" => $google_user->name
            ]);

            $user->social()->create([
                "provider_id" => $google_user->id,
                "provider_token" => $google_user->token,
                "provider_refresh_token" => $google_user->refreshToken
            ]);
            Auth::login($user);
        });


        return redirect("/");
    }
}
