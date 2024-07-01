<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->user = User::factory()->create();
});


it('should use name for display name', function() {
    expect($this->user->displayName())->toEqual($this->user->name);
});

?>
