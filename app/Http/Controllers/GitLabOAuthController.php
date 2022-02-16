<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GitLabOAuthController extends Controller
{
    public function login()
    {
        return Socialite::driver('gitlab-new')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('gitlab-new')->user();
        if($user->user['state'] != 'active')
            return redirect()->route('login.disabled');

        $dbUser = User::firstOrNew([
            'gitlab_id' => $user->getId(),
        ], [
            'name'     => $user->getName(),
            'email'    => $user->getEmail(),
            'username' => $user->getNickname(),
        ]);
        $dbUser->last_login = now();
        $dbUser->save();

        \Auth::login($dbUser);

        return redirect()->route('home');
    }

    public function disabled()
    {
        return "Your GitLab account is inactive, please contact it service if you think this is a mistake";
    }
}
