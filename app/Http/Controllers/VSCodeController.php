<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Cache;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VSCodeController extends Controller
{
    public function authenticate(Request $request)
    {
        $validated = Validator::make($request->all(), ['token' => 'required']);
        if ($validated->fails())
            return "Token missing";
        Cache::remember('vs-code-auth:' . $request->get('token'), 180, fn() => auth()->id());

        return "Successfully logged in, you may now close this window.";
    }

    public function retrieveAuthentication(Request $request)
    {
        $validated = Validator::make($request->all(), ['token' => 'required']);
        if ($validated->fails())
            return response("Token missing", 400);
        $token = $request->get('token');
        if (!Cache::has("vs-code-auth:$token"))
            return response(['type' => 'error', 'message' => 'Not found'], 404);

        $userId = Cache::get("vs-code-auth:$token");
        $user = User::find($userId);
        $userToken = $user->createToken("vs-code");
        Cache::forget("vs-code-auth:$token");

        return [
            'type' => 'success',
            'token' => $userToken->plainTextToken,
            'name' => $user->name
        ];
    }

    public function courses()
    {
        return auth()->user()->courses()->withCount('members')->get();
    }

    public function courseTasks(Course $course)
    {
        $tasks = $course->tasks()->with(['projects'=> function(HasMany $query){
     
        }])->get();
        $tasks->makeHidden('description');
        $tasks->makeHidden('markdown_description');
        return $tasks;
    }
}
