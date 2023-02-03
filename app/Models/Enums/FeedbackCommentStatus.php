<?php

namespace App\Models\Enums;

enum FeedbackCommentStatus: string
{
    case Draft = 'draft';
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
