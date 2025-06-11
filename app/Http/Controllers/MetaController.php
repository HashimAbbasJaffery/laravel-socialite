<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class MetaController extends Controller
{
    public function redirect() {
        return Socialite::driver("facebook")->redirect();
    }

    public function callback() {
        $meta_user = Socialite::driver("facebook")->user();
      
        $user = null;
        DB::transaction(function() use ($meta_user) {
            $user = User::updateOrCreate([
                "email" => $meta_user->email
            ], [
                "name" => $meta_user->name
            ]);

            $user->social()->create([
                "provider_id" => $meta_user->id,
                "provider_token" => $meta_user->token,
                "provider_refresh_token" => $meta_user->refreshToken
            ]);
            Auth::login($user);
        });


        return redirect("/");
    }
}
