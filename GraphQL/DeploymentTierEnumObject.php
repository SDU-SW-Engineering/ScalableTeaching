<?php

namespace GraphQL\SchemaObject;

class DeploymentTierEnumObject extends EnumObject
{
    const PRODUCTION = "PRODUCTION";
    const STAGING = "STAGING";
    const TESTING = "TESTING";
    const DEVELOPMENT = "DEVELOPMENT";
    const OTHER = "OTHER";
}
