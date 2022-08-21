<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
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

        $dbUser = User::where('gitlab_id', $user->getId())->orWhere('email', $user->getEmail())->firstOrNew();
        $dbUser->name = $user->getName();
        $dbUser->email = $user->getEmail();
        $dbUser->username = $user->getNickname();
        $dbUser->access_token = $user->token;
        $dbUser->last_login = now();

        try
        {
            $avatarResponse = Http::withHeaders(['Authorization' => 'Bearer ' . $user->token])->get($user->avatar);
            $avatar = Image::make($avatarResponse->body());

            $image = (string)$avatar->resize(100, 100)->encode('data-url');

            if(md5($image) != md5($dbUser->avatar))
                $dbUser->avatar = $image;

        } catch(\Exception $exception)
        {

        }
        $dbUser->save();

        \Auth::login($dbUser);

        return redirect()->intended(route('home'));
    }

    public function disabled()
    {
        return "Your GitLab account is inactive, please contact it service if you think this is a mistake";
    }
}
