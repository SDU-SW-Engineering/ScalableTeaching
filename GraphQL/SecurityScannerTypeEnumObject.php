<?php

namespace GraphQL\SchemaObject;

class SecurityScannerTypeEnumObject extends EnumObject
{
    const SAST = "SAST";
    const SAST_IAC = "SAST_IAC";
    const DAST = "DAST";
    const DEPENDENCY_SCANNING = "DEPENDENCY_SCANNING";
    const CONTAINER_SCANNING = "CONTAINER_SCANNING";
    const SECRET_DETECTION = "SECRET_DETECTION";
    const COVERAGE_FUZZING = "COVERAGE_FUZZING";
    const API_FUZZING = "API_FUZZING";
    const CLUSTER_IMAGE_SCANNING = "CLUSTER_IMAGE_SCANNING";
}
