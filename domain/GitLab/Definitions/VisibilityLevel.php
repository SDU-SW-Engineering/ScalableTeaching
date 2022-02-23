<?php

namespace Domain\GitLab\Definitions;

enum VisibilityLevel : int
{
    case Public = 20;
    case Internal = 10;
    case Private = 0;
}
