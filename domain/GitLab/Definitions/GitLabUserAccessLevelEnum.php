<?php

namespace Domain\GitLab\Definitions;

/**
 * The values for this enum is for a project member, that defines what permissions they have.
 * @link https://docs.gitlab.com/ee/api/access_requests.html#valid-access-levels Project member valid access levels
 * @link https://docs.gitlab.com/ee/user/permissions.html#project-members-permissions Project member permission table
 */
enum GitLabUserAccessLevelEnum : int
{
    case NO_ACCESS = 0;
    case MINIMAL_ACCESS = 5;
    case GUEST = 10;
    case REPORTER = 20;
    case DEVELOPER = 30;
    case MAINTAINER = 40;
    case OWNER = 50;
}
