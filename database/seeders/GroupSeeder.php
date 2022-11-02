<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Course $course */
        foreach (Course::all() as $course) {
            /** @var Collection<int,Group> $groups */
            $groups = Group::factory(4)->for($course)->create();
            $course->members->each(fn (User $member) => $member->groups()->attach($groups->pluck('id')->random(rand(0, $groups->count()))));
        }
    }
}
