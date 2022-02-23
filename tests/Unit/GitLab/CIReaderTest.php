<?php

use Domain\GitLab\CIReader;
use function Pest\testDirectory;

beforeEach(function ()
{
    $this->reader = new CIReader(file_get_contents(testDirectory("Unit/GitLab/Stubs/tasks.yml")));
});

it('extracts three tasks from a ci file', function ()
{
    expect($this->reader->tasks())->toHaveCount(3);
    expect($this->reader->tasks()[0]->getStage())->toBe('install');
    expect($this->reader->tasks()[0]->getName())->toBe('install');
    expect($this->reader->tasks()[1]->getStage())->toBe('test');
    expect($this->reader->tasks()[1]->getName())->toBe('test 9 equals [5,2,2]');
    expect($this->reader->tasks()[2]->getStage())->toBe('test');
    expect($this->reader->tasks()[2]->getName())->toBe('test 11 equals [10, 1]');
});

it('extracts two stages from a ci file', function ()
{
    expect($this->reader->stages())->toHaveCount(2);
    expect($this->reader->stages())->toMatchArray(["install", "test"]);
    expect($this->reader->stage("install"))->toHaveCount(1);
    expect($this->reader->stage("test"))->toHaveCount(2);
});

