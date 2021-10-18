<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\User as UserModel;
use Badcow\PhraseGenerator\PhraseGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GroupController extends Controller
{
    public function index(Course $course)
    {
        dd(auth()->user());
        $user = UserModel::firstWhere(['guid' => auth()->id()]);

        $canCreateMoreCourses = $user->can('createGroup', $course);
        dd($canCreateMoreCourses);
        return view('groups.index', [
            'course'      => $course,
            'breadcrumbs' => [
                'Courses'     => route('courses.index'),
                $course->name => null
            ],
            'groups'      => $course->userGroups($user->id, true)
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function create(Course $course)
    {
        $groupRequest = request()->validate([
            'name' => ['required', 'alpha_hyphen']
        ]);

        $user = UserModel::firstWhere(['guid' => auth()->id()]);

        throw_if($course->groups()->where($groupRequest)->exists(), ValidationException::withMessages(['A group with this name already exists']));

        $group = $course->groups()->create($groupRequest);
        $group->users()->attach($user->id, ['is_owner' => true]);

        return $course->userGroups($user->id, true);
    }
}
