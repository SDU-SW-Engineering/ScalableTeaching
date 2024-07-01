<?php

use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->group = Group::factory()->for(Course::factory())->create();

    $this->user1 = User::factory()->create();
    $this->user2 = User::factory()->create();

    $this->group->members()->attach([$this->user1->id, $this->user2->id]);
});

it('should use group name and group member names for display name method', function() {
    expect($this->group->displayName())->toEqual($this->group->name . ' (' . $this->group->memberString . ')');
});

?>
