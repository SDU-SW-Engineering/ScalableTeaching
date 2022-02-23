<?php

namespace GraphQL\SchemaObject;

class PackageDependencyTypeEnumObject extends EnumObject
{
    const DEPENDENCIES = "DEPENDENCIES";
    const DEV_DEPENDENCIES = "DEV_DEPENDENCIES";
    const BUNDLE_DEPENDENCIES = "BUNDLE_DEPENDENCIES";
    const PEER_DEPENDENCIES = "PEER_DEPENDENCIES";
}
