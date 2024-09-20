<?php

namespace GraphQL\SchemaObject;

class CiConfigIncludeTypeEnumObject extends EnumObject
{
    const REMOTE = "remote";
    const LOCAL = "local";
    const FILE = "file";
    const TEMPLATE = "template";
    const COMPONENT = "component";
}
