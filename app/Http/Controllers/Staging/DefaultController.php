<?php

namespace App\Http\Controllers\Staging;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DefaultController extends Controller
{
    public function resetEnvironment() : string
    {
        Artisan::call('migrate:fresh --seed --no-interaction');
        session()->flush();

        return "Ok";
    }

    public function impersonate(int $userId) : string
    {
        if ($userId == -1)
        {
            auth()->logout();

            return redirect()->home();
        }

        auth()->loginUsingId($userId);

        return redirect('/');
    }
}
