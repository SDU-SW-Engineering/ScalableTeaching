<?php

namespace GraphQL\SchemaObject;

class AccessLevelEnumEnumObject extends EnumObject
{
    const NO_ACCESS = "NO_ACCESS";
    const MINIMAL_ACCESS = "MINIMAL_ACCESS";
    const GUEST = "GUEST";
    const REPORTER = "REPORTER";
    const DEVELOPER = "DEVELOPER";
    const MAINTAINER = "MAINTAINER";
    const OWNER = "OWNER";
}
