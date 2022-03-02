<?php

namespace App;

enum WebhookTypes : string
{
    case Job = "Job Hook";
    case Pipeline = "Pipeline Hook";
    case Push = "Push Hook";
}
