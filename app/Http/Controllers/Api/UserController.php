<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search()
    {
        $validated = \request()->validate(['q' => ['required', 'min:3']]);
        $query     = $validated['q'];
        $users     = User::where('name', 'like', "%$query%")->orWhere('email', 'like', "%$query%");
        return $users->take(5)->get();
    }
}
