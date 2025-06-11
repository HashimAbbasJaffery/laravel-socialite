<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SlackController extends Controller
{
    public function redirect() {
        return Socialite::driver("slack")->redirect();
    }

    public function callback() {
        $slack_user = Socialite::driver("slack")->user();
      
        $user = null;
        DB::transaction(function() use ($slack_user) {
            $user = User::updateOrCreate([
                "email" => $slack_user->email
            ], [
                "name" => $slack_user->name
            ]);

            $user->social()->create([
                "provider_id" => $slack_user->id,
                "provider_token" => $slack_user->token,
                "provider_refresh_token" => $slack_user->refreshToken
            ]);
            Auth::login($user);
        });


        return redirect("/");
    }
}
