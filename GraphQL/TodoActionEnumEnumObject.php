<?php

namespace GraphQL\SchemaObject;

class TodoActionEnumEnumObject extends EnumObject
{
    const ASSIGNED = "assigned";
    const MENTIONED = "mentioned";
    const BUILD_FAILED = "build_failed";
    const MARKED = "marked";
    const APPROVAL_REQUIRED = "approval_required";
    const UNMERGEABLE = "unmergeable";
    const DIRECTLY_ADDRESSED = "directly_addressed";
    const MERGE_TRAIN_REMOVED = "merge_train_removed";
    const REVIEW_REQUESTED = "review_requested";
    const MEMBER_ACCESS_REQUESTED = "member_access_requested";
    const REVIEW_SUBMITTED = "review_submitted";
    const OKR_CHECKIN_REQUESTED = "okr_checkin_requested";
}
