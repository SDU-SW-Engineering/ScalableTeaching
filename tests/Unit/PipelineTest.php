<?php

use App\Models\Enums\PipelineStatusEnum;
use App\Models\Pipeline;

it('ensures a failing pipeline is not upgradable', function () {
    $pipeline = new Pipeline();
    $pipeline->status = PipelineStatusEnum::Failed;

    expect($pipeline->isUpgradable(PipelineStatusEnum::Pending))->toBeFalse();
    expect($pipeline->isUpgradable(PipelineStatusEnum::Success))->toBeTrue();
    expect($pipeline->isUpgradable(PipelineStatusEnum::Running))->toBeFalse();
});

it('ensures a succeeding pipeline is upgradable', function () {
    $pipeline = new Pipeline();
    $pipeline->status = PipelineStatusEnum::Success;

    expect($pipeline->isUpgradable(PipelineStatusEnum::Pending))->toBeFalse();
    expect($pipeline->isUpgradable(PipelineStatusEnum::Failed))->toBeTrue();
    expect($pipeline->isUpgradable(PipelineStatusEnum::Running))->toBeFalse();
});

it('ensures a pending pipeline is upgradable to running, success and failed', function () {
    $pipeline = new Pipeline();
    $pipeline->status = PipelineStatusEnum::Pending;

    expect($pipeline->isUpgradable(PipelineStatusEnum::Success))->toBeTrue();
    expect($pipeline->isUpgradable(PipelineStatusEnum::Failed))->toBeTrue();
    expect($pipeline->isUpgradable(PipelineStatusEnum::Running))->toBeTrue();
});

it('ensures a running pipeline is upgradable to success and failed', function () {
    $pipeline = new Pipeline();
    $pipeline->status = PipelineStatusEnum::Running;

    expect($pipeline->isUpgradable(PipelineStatusEnum::Success))->toBeTrue();
    expect($pipeline->isUpgradable(PipelineStatusEnum::Failed))->toBeTrue();
    expect($pipeline->isUpgradable(PipelineStatusEnum::Pending))->toBeFalse();
});
