<?php

namespace Domain\GitLab\Kinds;

abstract class WebhookEvent
{
    abstract function Hydrate(array $array);
}
