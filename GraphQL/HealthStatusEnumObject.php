<?php

namespace GraphQL\SchemaObject;

class HealthStatusEnumObject extends EnumObject
{
    const ONTRACK = "onTrack";
    const NEEDSATTENTION = "needsAttention";
    const ATRISK = "atRisk";
}
