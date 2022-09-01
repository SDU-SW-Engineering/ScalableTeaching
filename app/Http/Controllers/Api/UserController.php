<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return Collection<int,User>
     */
    public function search() : Collection
    {
        $validated = \request()->validate(['q' => ['required', 'min:3']]);
        $query = $validated['q'];
        $users = User::where('name', 'like', "%$query%")->orWhere('email', 'like', "%$query%");

        return $users->take(5)->get();
    }
}
