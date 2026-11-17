<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class GitLabOAuthController extends Controller
{
    public function login() : RedirectResponse
    {
        return Socialite::driver('gitlab-new')->redirect();
    }

    public function callback() : RedirectResponse
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
        $dbUser->gitlab_id = $user->getId();

        if ( ! empty($user->avatar))
        {
            try
            {
                $avatarResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $user->token,
                ])->timeout(10)->get($user->avatar);

                $avatarResponse->throw();

                $avatar = Image::make($avatarResponse->body());
                $image = (string) $avatar->resize(100, 100)->encode('data-url');

                if ($image !== $dbUser->avatar)
                {
                    $dbUser->avatar = $image;
                }
            } catch (\Throwable $exception)
            {
                report($exception);
            }
        }
        
        $dbUser->save();

        \Auth::login($dbUser);

        return redirect()->intended(route('home'));
    }

    public function disabled() : string
    {
        return "Your GitLab account is inactive, please contact it service if you think this is a mistake";
    }
}
